<?php namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Abraham\TwitterOAuth\TwitterOAuth;
use Carbon\Carbon;
use DateInterval;

use App\User;
use App\DeleteStat;

class SearchTweets extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'tweet:run';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Search OPTC tweets and remove them.';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct(){
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire(){
		$this->info('START  '.date("d/m/Y H:i:s"));
		$this->info('');

		$newDay = new DateInterval('PT4H'); //Snail day start at 4am PST

		$users	= User::where('tweet_remover_enabled',true)->get();

		foreach($users as $user)
		{
			$deleted	= 0;
			$connection = new TwitterOAuth(env('TWITTER_CONSUMER'), env('TWITTER_CONSUMER_SECRET'), $user->oauth_token, $user->oauth_token_secret);
			$tweets	= $connection->get("statuses/user_timeline", ["count" => 10, "exclude_replies" => true]);

			if($connection->getLastHttpCode() === 200)
			{
				foreach ($tweets as $tweet)
				{
					if(strpos($tweet->text, "Found a Transponder Snail!")===0){
						$connection->post('statuses/destroy', [ "id" => $tweet->id_str ]);

						if($connection->getLastHttpCode() === 200)
						{
							$deleted++;
							$tweet_date	= Carbon::parse($tweet->created_at)->setTimezone('PST')->sub($newDay)->setTime(0,0,0);

							$deleteStat	= DeleteStat::where('user_id',$user->id)->where('data',$tweet_date)->first();

							if(is_null($deleteStat)){
								$deleteStat	= new DeleteStat;

								$deleteStat->user_id	= $user->id;
								$deleteStat->data		= $tweet_date;
								$deleteStat->count		= 1;
							} else {
								$deleteStat->count	+= 1;
							}

							$deleteStat->save();
						} 
						else
						{
							$this->error('Error while deleting tweet ( '.$tweet->id_str.' )');
							$this->error($tweet->text);
						}
					}
				}
			}

			$this->info(sprintf("%-15s: %2d",$user->username,$deleted));
		}

		$this->info('');
		$this->info('DONE   '.date("d/m/Y H:i:s"));
	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments(){
		return [
			//
		];
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions(){
		return [
			//['example', null, InputOption::VALUE_OPTIONAL, 'An example option.', null],
		];
	}

}

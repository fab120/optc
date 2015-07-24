<?php namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Abraham\TwitterOAuth\TwitterOAuth;

use App\User;

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
		$date	= date("d/m/Y");
		$this->info('START  '.date("d/m/Y H:i:s"));
		$this->info('');

		$users	= User::all();

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
						} 
						else
						{
							$this->error('Error while deleting tweet ( '.$tweet->id_str.' )');
							$this->error($tweet->text);
						}
					}
				}
			}
			
			if($deleted>0)
			{
				$prec	= 0;
				if(isset($user->deleteStat))
				{
					$max	= count($user->deleteStat);
					for($k=0;$k<$max;$k++)
					{
						if($user->deleteStat[$k]['date'] === $date){
							$prec	= (int) $user->deleteStat[$k]['count'];
							$user->pull('deleteStat', [ 'date' => $date ] );
							break;
						}
					}
				}

				$user->push('deleteStat', [ "date" => $date , "count" => $deleted + $prec ]);
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

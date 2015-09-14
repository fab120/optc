<?php namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use App\User;
use App\DeleteStat;
use Auth;
use Carbon\Carbon;
use DateInterval;

class TweetStat extends BaseController
{
	public function index()
	{

		$data	= [];

		if(Auth::check())
		{
			$data['history']	= [];

			$nowPST = Carbon::now()->setTimezone('UTC')->sub(new DateInterval('PT12H'));

			$hist	= DeleteStat::where('user_id',Auth::user()->id)->orderby('data','desc')->take(10)->get();
			$first 	= true;
			foreach($hist as $h)
			{
				if($first){
					if($h->data->format('d/m/Y') !== $nowPST->format('d/m/Y'))
					{
						$data['history'][]	= (object) [ "data" => $nowPST, "count" => 0 ];
					}
				}

				$data['history'][]	= $h;

				$first = false;
			}

			$data['max']		= count($data['history']);
			$data['pstTime']	= Carbon::now()->setTimezone('UTC')->sub(new DateInterval('PT8H'));
		}

		return view('tweetstat.index', $data);

	}

}

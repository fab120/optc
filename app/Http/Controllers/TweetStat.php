<?php namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use App\User;
use App\DeleteStat;
use Auth;

class TweetStat extends BaseController
{
	public function index()
	{

		$data	= [];

		if(Auth::check())
		{
			$data['history']	= DeleteStat::where('user_id',Auth::user()->id)->orderby('data','desc')->take(11)->get();
			$data['max']		= count($data['history']);
		}

		return view('tweetstat.index', $data);

	}

}

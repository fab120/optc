<?php namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use App\User;
use Auth;

class TweetStat extends BaseController
{
	public function index()
	{

		$data	= [];

		if(Auth::check())
		{
			
		}

		return view('tweetstat.index', $data);

	}

}

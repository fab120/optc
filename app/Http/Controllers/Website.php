<?php namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use DB;
use Cache;
use Carbon\Carbon;
use DateInterval;

class Website extends BaseController
{
	public function stats ()
	{

		$data = [
			"user"		=> Cache::remember('stats_totusers', 10, function() {
				return DB::table('users')->count();
			}),
			
			"history"	=> Cache::remember('stats_history', 30, function() {
				return DB::table('deletestats')
				->select(DB::raw('DATE_FORMAT(data, "%d/%m/%Y") as data'), DB::raw('SUM(count) as total'))
				->groupby('data')
				->orderby('data','desc')
				->take(30)
				->get();
			}),

			"history_total"	=> Cache::remember('stats_history_total', 60, function() {
				return DB::table('deletestats')->select(DB::raw("SUM(count) as total"))->first()->total;
			}),
			"pstTime"		=> Carbon::now()->setTimezone('UTC')->sub(new DateInterval('PT8H')),
		];

		return view("website.stats",$data);
	}

	public function links ()
	{
		return view("website.links");
	}

}

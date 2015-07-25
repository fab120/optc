<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class DeleteStat extends Model {

	protected $table = 'deletestats';

	protected $dates = [ 'data' ];

	public function user ()
	{
		return $this->belongsTo('App\User');
	}

}

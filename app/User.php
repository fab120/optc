<?php namespace App;

use Jenssegers\Mongodb\Model as Eloquent;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

class User extends Eloquent implements AuthenticatableContract
{

	use Authenticatable;

    protected $collection = 'users';

}
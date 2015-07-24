<?php namespace App;

use Jenssegers\Mongodb\Model as Eloquent;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

class User extends Eloquent implements AuthenticatableContract {

    protected $collection = 'users';

}
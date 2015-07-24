<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

$app->get('/', function() use ($app) {
    return view('index');
});

$app->get('/login', [
    'as' => 'login', 'uses' => 'Login@login'
]);

$app->get('/oauth2', [
    'as' => 'oauth2', 'uses' => 'Login@oauth2'
]);

$app->get('/key', function(){
	return str_random(32);
});

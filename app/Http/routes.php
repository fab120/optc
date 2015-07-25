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

$app->get('/', [
	'uses' => 'TweetStat@index'
]);

$app->get('/login', [
    'as' => 'login', 'uses' => 'Login@login'
]);

$app->get('/oauth2', [
    'as' => 'oauth2', 'uses' => 'Login@oauth2'
]);

$app->get('/logout', function() use ($app) {
	Auth::logout();
	return redirect('/');
});

$app->get('/stats', [
    'uses' => 'Website@stats'
]);

$app->get('/links', [
    'uses' => 'Website@links'
]);

$app->get('/version', function() use ($app) {
	$file = base_path('VERSION.txt');

	if(file_exists($file))
	{
		return "Version: ".file_get_contents($file);
	}
	else
	{
		return "Version: development";
	}
});

$app->get('/test', function() use ($app) {
	if($app->environment()==="local")
	{
		$user	= App\User::where('id', '258880711')->first();
		\Auth::login($user);
	}
    return redirect('/');
});

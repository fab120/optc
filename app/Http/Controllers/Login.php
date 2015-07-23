<?php namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use Abraham\TwitterOAuth\TwitterOAuth;

class Login extends BaseController
{
    public function login(){

    	$connection = new TwitterOAuth(env('TWITTER_CONSUMER'), env('TWITTER_CONSUMER_SECRET'));
    	$token = $connection->oauth("oauth/request_token");
    	/*
	    	Array
			(
			    [oauth_token] => dWz8AQAAAAAAguGEAAABTrvkcQc
			    [oauth_token_secret] => Oz5dXm8S9uEpUd8zGFOP0gz7JPF78oXI
			    [oauth_callback_confirmed] => true
			)
    	 */
    	return redirect('https://api.twitter.com/oauth/authenticate?oauth_token='.$token['oauth_token']);
    }

    public function oauth2(){
    	return "oauth2";
    }
}

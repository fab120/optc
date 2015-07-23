<?php namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Abraham\TwitterOAuth\TwitterOAuth;

class Login extends BaseController
{
	private $connection	= null;
	public function __construct()
	{
		$this->connection	= new TwitterOAuth(env('TWITTER_CONSUMER'), env('TWITTER_CONSUMER_SECRET'));
	}

    public function login()
    {

    	$connection = 
    	$token = $this->connection->oauth('oauth/request_token');
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

    public function oauth2(Request $request)
    {
    	$oauth_token	= $request->input('oauth_token');
    	$oauth_verifier	= $request->input('oauth_verifier');

    	$access_token	= $this->connection->oauth('oauth/access_token', [ "oauth_verifier" => $oauth_verifier ];
    	
    	return print_r($access_token,true);
    }
}

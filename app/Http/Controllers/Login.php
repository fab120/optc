<?php namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Abraham\TwitterOAuth\TwitterOAuth;

class Login extends BaseController
{
    public function login(Request $request)
    {

    	$connection = new TwitterOAuth(env('TWITTER_CONSUMER'), env('TWITTER_CONSUMER_SECRET'));
    	$token = $connection->oauth('oauth/request_token');

    	$request->session()->put('oauth_token', $token['oauth_token']);
    	$request->session()->put('oauth_token_secret', $token['oauth_token_secret']);
    	
    	return redirect('https://api.twitter.com/oauth/authenticate?oauth_token='.$token['oauth_token']);
    }

    public function oauth2(Request $request)
    {
    	$oauth_token		= $request->session()->get('oauth_token');
    	$oauth_token_secret	= $request->session()->get('oauth_token_secret');

    	$connection = new TwitterOAuth(env('TWITTER_CONSUMER'), env('TWITTER_CONSUMER_SECRET'), $oauth_token, $oauth_token_secret);

    	$oauth_token	= $request->input('oauth_token');
    	$oauth_verifier	= $request->input('oauth_verifier');

    	$access_token	= $connection->oauth('oauth/access_token', [ "oauth_verifier" => $oauth_verifier ]);
    	
    	return print_r($access_token,true);
    }
}

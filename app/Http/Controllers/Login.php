<?php namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Abraham\TwitterOAuth\TwitterOAuth;
use App\User;
use Auth;

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
		$oauth_verifier		= $request->input('oauth_verifier');

		$connection = new TwitterOAuth(env('TWITTER_CONSUMER'), env('TWITTER_CONSUMER_SECRET'), $oauth_token, $oauth_token_secret);
		$access_token	= $connection->oauth('oauth/access_token', [ "oauth_verifier" => $oauth_verifier ]);

		$request->session()->forget('oauth_token');
		$request->session()->forget('oauth_token_secret');

		$user	= User::where('id', $access_token['user_id'])->first();

		if(is_null($user)){
			$user	= new User;
		}

		$user->oauth_token			= $access_token['oauth_token'];
		$user->oauth_token_secret	= $access_token['oauth_token_secret'];
		$user->id					= $access_token['user_id'];
		$user->username				= $access_token['screen_name'];

		$user->save();

		Auth::login($user);
		
		return redirect('/');
	}
}

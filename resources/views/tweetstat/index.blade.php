@extends('template')

@section('content')

<div class="container">
	<div class="row">
		<div class="col-sm-12">
			<div class="page-header">
				<h1>Transponder Snail Tweet Remover</h1>
			</div>
			<p>This tool will look at your twitter timeline every 10 minutes and will delete the tweets that start with <strong>Found a Transponder Snail!</strong>.</p>
			@if(Auth::check())
				@if($max>0)
					<h2>Tweets removed today</h2>
					<p>{{ $history[0]->count }}</p>
					@if($max>1)
					<h2>History</h2>
						<table class="table table-bordered">
							@for($k=1;$k<$max;$k++)
								<tr>
									<th>{{ $history[$k]->data->format('d/m/Y') }}</th>
									<td>{{ $history[$k]->count }}</td>
								</tr>
							@endfor
						</table>
					@endif
				@else
					<h2>We have not removed any tweet from your account yet.</h2>
				@endif
			@else
				<h2>Statistics</h2>
				<p>You can see how many transponder snails have you found every day.</p>
				<h2>Let's start!</h2>
				<p>
					To start you have to allow this application to access to your twitter account.<br>
					Since we are using OAUTH2 tokens we don't need (and absolutely don't want) to know your password.
				</p>
				<p>
					This application will retrive your last 10 tweets and will remove all those starting with <strong>Found a Transponder Snail!</strong>.
				</p>
				<!--<h3>You have other doubts?</h3>
				<p>
					You can see the source code on <a href="https://github.com/fab120/optc">GitHub</a>.
				</p>-->
				<h2>Sign-in with Twitter</h2>
				<p>
					<a href="{{ url('login') }}"><img src="{{ url('assets/img/signin.png') }}" alt="Sign-in with Twitter"></a>
				</p>
			@endif
		</div>
	</div>
</div>

@endsection
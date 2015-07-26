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
					<h2>Today</h2>
					<table class="table table-bordered">
						<tr>
							<th>Day</th>
							<th>Transponder Snails found</th>
						</tr>
						<tr>
							<th>{{ $history[0]->data->format('d/m/Y') }}</th>
							<td>{{ $history[0]->count }}</td>
						</tr>
					</table>
					@if($max>1)
					<h2>History</h2>
						<table class="table table-bordered">
							<tr>
								<th>Day</th>
								<th>Transponder Snails found</th>
							</tr>
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
				<p class="text-muted">
					All dates are in PST time.<br>
					It may take up to 10 minutes to this page to be updated.
				</p>
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
				<h2>Sign-in with Twitter</h2>
				<p>
					<a href="{{ url('login') }}"><img src="{{ url('assets/img/signin.png') }}" alt="Sign-in with Twitter"></a>
				</p>
			@endif
		</div>
	</div>
</div>

@endsection
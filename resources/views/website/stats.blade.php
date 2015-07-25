@extends('template')

@section('content')

<div class="container">
	<div class="row">
		<div class="col-sm-12">
			<div class="page-header">
				<h1>Statistics</h1>
			</div>
			<h3>User using this application:</h3>
			<p>{{ $user }}</p>
			<h3>Tweets deleted in last 30 days:</h3>
			<table class="table table-bordered">
				<tr>
					<th>Day</th>
					<th>Tweets deleted</th>
				</tr>
				@foreach($history as $h)
					<tr>
						<th>{{ $h->data }}</th>
						<td>{{ $h->total }}</td>
					</tr>
				@endforeach
			</table>
			<h3>Total Tweets deleted by this application:</h3>
			<p>{{ $history_total }}</p>
		</div>
	</div>
</div>

@endsection
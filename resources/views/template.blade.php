<!doctype html>
<html class="no-js" lang="">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="x-ua-compatible" content="ie=edge">
		<title>OPTC Tools</title>
		<meta name="description" content="">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<link rel="apple-touch-icon" href="apple-touch-icon.png">

		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
		<link rel="stylesheet" href="{{ url('assets/css/main.css') }}">
		<script src="{{ url('assets/js/modernizr-2.8.3.min.js') }}"></script>
	</head>
	<body>
		<!--[if lt IE 8]>
			<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
		<![endif]-->

		<nav class="navbar navbar-default">
			<div class="container-fluid">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#main-menu" aria-expanded="false">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="{{ url('/') }}">OPTC Tools</a>
				</div>

				<div class="collapse navbar-collapse" id="main-menu">
					<ul class="nav navbar-nav">
						<li><a href="{{ url('/') }}">Tweet Remover</a></li>
						<li><a href="{{ url('stats') }}">Statistics</a></li>
						<li><a href="{{ url('links') }}">OPTC Useful links</a></li>
					</ul>
					<ul class="nav navbar-nav navbar-right">
						@if(Auth::check())
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Welcome {{ Auth::user()->username }} <span class="caret"></span></a>
								<ul class="dropdown-menu">
									<li><a href="{{ url('logout') }}">Logout</a></li>
									<!--<li><a href="#">Another action</a></li>
									<li><a href="#">Something else here</a></li>
									<li role="separator" class="divider"></li>
									<li><a href="#">Separated link</a></li>-->
								</ul>
							</li>
						@else
							<li><a href="{{ url('login') }}" class="twitter-login"><img src="{{ url('assets/img/signin.png') }}" alt="Sign-in with Twitter"></a></li>
						@endif
					</ul>
				</div>
			</div>
		</nav>

		<section class="header-message">
			<div class="container">
				<div class="row">
					<div class="col-sm-12">
						<div class="alert alert-warning" role="alert">
							<strong>Warning:</strong> This service will be discontinued the 31th of January 2016.
						</div>
					</div>
				</div>
			</div>
		</section>

		@yield('content')

		<footer class="footer">
			<div class="container">
				<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top" class="pull-right">
					<input type="hidden" name="cmd" value="_s-xclick">
					<input type="hidden" name="encrypted" value="-----BEGIN PKCS7-----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-----END PKCS7-----
					">
					<input type="image" src="https://www.paypalobjects.com/en_GB/i/btn/btn_donate_LG.gif" border="0" name="submit" alt="PayPal – The safer, easier way to pay online.">
					<img alt="" border="0" src="https://www.paypalobjects.com/it_IT/i/scr/pixel.gif" width="1" height="1">
				</form>
				<p class="text-muted">Beta version - by <a href="https://twitter.com/fab1200" target="_blank">fab1200</a><span class="hidden-xs"> - </span><br class="visible-xs-inline">Source code on <a href="https://github.com/fab120/optc" target="_blank">GitHub</a></p>
			</div>
		</footer>

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
		<script src="{{ url('assets/js/main.js') }}"></script>

		<script>
			(function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
			function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
			e=o.createElement(i);r=o.getElementsByTagName(i)[0];
			e.src='https://www.google-analytics.com/analytics.js';
			r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
			ga('create','UA-65600590-1','auto');ga('send','pageview');
		</script>
	</body>
</html>

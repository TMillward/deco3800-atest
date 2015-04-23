@extends("prototypeone.template.master")

@section("title", "Whoops! You are not logged in")

@section("content")
	<div class="container">
		<h1>Invalid Access</h1>
		<p>
		You aren't supposed to be here. You need to be logged in and 
		accessing your own pages. Please click below to go to the login 
		page to login and access your account and possessions.
		</p>
	</div>
	
	<div class="container">
		<p>{!! HTML::link(".", "Back to login page") !!}</p>
	</div>
@stop



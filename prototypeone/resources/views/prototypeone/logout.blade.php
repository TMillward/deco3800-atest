@extends("prototypeone.template.master")

@section("title", "Logout Successful")

@section("content")
	<div class="container">
		<h1>You have successfully logged out of the site</h1>
		<p>Please click the link at the bottom to go back to the login page</p>
	</div>
	
	<div class="container">
		<p>{!! HTML::link(".", "Back to login page") !!}</p>
	</div>
@stop



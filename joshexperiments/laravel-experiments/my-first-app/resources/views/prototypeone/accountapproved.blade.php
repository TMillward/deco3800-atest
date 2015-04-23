@extends("prototypeone.template.master")

@section("title", "Account Creation Successful")

@section("content")
	<div class="container">
		<h1>Your Account Has Been Successfully Created!</h1>
		<p>
		Your account has been successfully created with the following information:
		</p>
		<p><strong>Username: </strong> {{ $user->username }} </p>
		<p><strong>Name: </strong> {{ $user->name }} </p>
		<p><strong>Email: </strong> {{ $user->email }} </p>
		<p><strong>Created At: </strong> {{ $user->created_at }} </p>
		<p><strong>Updated At: </strong> {{ $user->updated_at }} </p>
	</div>
	
	<div class="container">
		<p>{!! HTML::link(".", "Back to login page") !!}</p>
	</div>
@stop



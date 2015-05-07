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
		@if ($user->usertype === "Professional")
			<p><strong>Title: </strong> {{ $extrainfo->title}} </p>
			<p><strong>About: </strong> {{ $extrainfo->about}} </p>
			<p><strong>Qualifications: </strong> {{ $extrainfo->qualifications}} </p>
		@elseif ($user->usertype === "Supplier")
			<p><strong>Street Number: </strong> {{ $extrainfo->street_number}} </p>
			<p><strong>Street Name: </strong> {{ $extrainfo->street_name}} </p>
			<p><strong>Suburb: </strong> {{ $extrainfo->suburb}} </p>
			<p><strong>State: </strong> {{ $extrainfo->state}} </p>
			<p><strong>Post Code: </strong> {{ $extrainfo->post_code}} </p>
			<p><strong>Work Phone Number: </strong> {{ $extrainfo->work_phone_number}} </p>
			<p><strong>Mobile Phone Number: </strong> {{ $extrainfo->mobile_phone_number}} </p>
			<p><strong>Description: </strong> {{ $extrainfo->description}} </p>
		@endif
	</div>
	
	<div class="container">
		<p>{!! HTML::link(".", "Back to login page") !!}</p>
	</div>
@stop



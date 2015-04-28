@extends("prototypeone.template.master")

@section("title", "Create a Seeker Account")

@section("content")
	<h1>Create A Seeker Account</h1>
	
	<div class="container">
		<h2>Enter your details here</h2>
		
		{!! Form::open(['route' => 'newaccount_path']) !!}
		
			<div class="form-group {{ $errors->has('username') ? 'has-error' : '' }}">
				{!! Form::label('username', 'Username (Limit is 32 Characters)') !!}
				{!! Form::text('username', null, ['class' => 'form-control', 
												  'placeholder' => "Enter Username Here"]) !!}
				{!! $errors->first('username', '<span class="help-block">:message</span>') !!}
			</div>
			
			<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
				{!! Form::label('name', 'Name (Limit is 255 characters)') !!}
				{!! Form::text('name', null, ['class' => 'form-control', 
											  'placeholder' => "Enter Your Full Name Here (e.g. Chuck Norris)"]) !!}
				{!! $errors->first('name', '<span class="help-block">:message</span>') !!}
			</div>
			
			<div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
				{!! Form::label('email', 'Email Address (optional)') !!}
				{!! Form::email('email', null, ['class' => 'form-control', 
												'placeholder' => "Enter Your Email Here (e.g. iwanttosleep@home.com)"]) !!}
				{!! $errors->first('email', '<span class="help-block">:message</span>') !!}
			</div>
			
			<div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
				{!! Form::label('password', 'Password (Limit is 60 characters)') !!}
				{!! Form::password('password', ['class' => 'form-control', 
												'placeholder' => "Enter Password Here (e.g. *******)"]) !!}
				{!! $errors->first('password', '<span class="help-block">:message</span>') !!}
			</div>
			
			<div class="form-group">
				{!! Form::hidden('usertype', 'Seeker') !!}
			</div>
			
			<div class="form-group">
				{!! Form::submit('Create Account', ['class' => 'btn btn-primary']) !!}
			</div>
			
		{!! Form::close() !!}
		
	</div>
	
	<div class="container">
		<p>{!! HTML::link("register", "Make a different account (discards your progress)") !!}</p>
	</div>
	
@stop
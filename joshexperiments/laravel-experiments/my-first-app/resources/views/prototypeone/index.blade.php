@extends("prototypeone.template.master")

@section("title", "Home Page")

@section("content")
	<h1>Welcome to Sprint Zero Prototype</h1>
	
	<div class="container">
		<p>{!! link_to_route('about_path', "About This Prototype") !!}</p>
	</div>
	
	<div class="container">
	
		<h2>Enter your details here to login</h2>
		
		{!! Form::open(['route' => 'login_path']) !!}
			<div class="form-group {{ $errors->has('username') ? 'has-error' : '' }}" >
				{!! Form::label('username', 'Username') !!}
				{!! Form::text('username', null, ['class' => 'form-control', 
												  'placeholder' => "Enter Username Here (e.g. MidSemBreakIsNotABreak)"]) !!}
				{!! $errors->first('username', '<span class="help-block">:message</span>') !!}
			</div>
			
			<div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
				{!! Form::label('password', 'Password') !!}
				{!! Form::password('password', ['class' => 'form-control', 
												  'placeholder' => "Enter Password Here (e.g. *******)"]) !!}
				{!! $errors->first('password', '<span class="help-block">:message</span>') !!}
			</div>
			
			@if ($errors->has('loginFailed'))
			<div class='has-error'>
				{!! $errors->first('loginFailed', '<span class="help-block">:message</span>') !!}
			</div>
			@endif
			
			<div class="form-group">
				{!! Form::submit('Log in', ['class' => 'btn btn-primary']) !!}
			</div>
			
		{!! Form::close() !!}
		
		
		
	</div>
	
	<div class="container">
		<p>{!! link_to_route("register_path", "Register A New Account") !!}</p>
	</div>
	
@stop
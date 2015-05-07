@extends("prototypeone.template.master")

@section("title", "Create a Professional Account")

@section("content")
	<h1>Create A Professional Account</h1>
	
	<div class="container">
		<h2>Enter your details here</h2>
		
		{!! Form::open(['route' => 'newaccount_path']) !!}
		
			<h3> Standard User Info </h3>
		
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
				{!! Form::hidden('usertype', 'Professional') !!}
			</div>
			
			<h3> Professional User Info </h3>
			
			<div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
				{!! Form::label('title', 'Title (Limit is 32 Characters)') !!}
				{!! Form::text('title', null, ['class' => 'form-control', 
												  'placeholder' => "Enter your title here (e.g. Sir, Dr., etc.)"]) !!}
				{!! $errors->first('title', '<span class="help-block">:message</span>') !!}
			</div>
			
			<div class="form-group {{ $errors->has('about') ? 'has-error' : '' }}">
				{!! Form::label('about', 
								'About You') !!}
				{!! Form::textarea('about', 
								    null, 
								  ['class' => 'form-control', 
								   'placeholder' => "Say something about yourself"]) !!}
				{!! $errors->first('about', 
								   '<span class="help-block">:message</span>') !!}
			</div>
			
			<div class="form-group {{ $errors->has('qualifications') ? 'has-error' : '' }}">
				{!! Form::label('qualifications', 
								'Qualifications') !!}
				{!! Form::textarea('qualifications', 
								    null, 
								  ['class' => 'form-control', 
								   'placeholder' => "Please tell us of your qualifications"]) !!}
				{!! $errors->first('qualifications', 
								   '<span class="help-block">:message</span>') !!}
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
@extends("prototypeone.template.master")

@section("title", "Create a Supplier Account")

@section("content")
	<h1>Create A Supplier Account</h1>
	
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
				{!! Form::hidden('usertype', 'Supplier') !!}
			</div>
			
			<h3> Supplier User Info </h3>
			
			<div class="form-group {{ $errors->has('street_number') ? 'has-error' : '' }}">
				{!! Form::label('street_number', 'Street Number (Limit is 255 characters)') !!}
				{!! Form::text('street_number', null, ['class' => 'form-control', 
											  'placeholder' => "Enter the street number of your address (e.g. 43, Lot 4/2, etc.)"]) !!}
				{!! $errors->first('street_number', '<span class="help-block">:message</span>') !!}
			</div>
			
			<div class="form-group {{ $errors->has('street_name') ? 'has-error' : '' }}">
				{!! Form::label('street_name', 'Street Name (Limit is 255 characters)') !!}
				{!! Form::text('street_name', null, ['class' => 'form-control', 
											  'placeholder' => "Enter the name of your street"]) !!}
				{!! $errors->first('street_name', '<span class="help-block">:message</span>') !!}
			</div>
			
			<div class="form-group {{ $errors->has('suburb') ? 'has-error' : '' }}">
				{!! Form::label('suburb', 'Suburb (Limit is 255 characters)') !!}
				{!! Form::text('suburb', null, ['class' => 'form-control', 
											  'placeholder' => "Enter your suburb (e.g. Brisbane, McDowall, etc.)"]) !!}
				{!! $errors->first('suburb', '<span class="help-block">:message</span>') !!}
			</div>
			
			<div class="form-group {{ $errors->has('state') ? 'has-error' : '' }}">
				{!! Form::label('state', 'State (Limit is 255 characters)') !!}
				{!! Form::text('state', null, ['class' => 'form-control', 
											  'placeholder' => "Enter the state in which you reside (e.g. QLD or Queensland)"]) !!}
				{!! $errors->first('state', '<span class="help-block">:message</span>') !!}
			</div>
			
			<div class="form-group {{ $errors->has('post_code') ? 'has-error' : '' }}">
				{!! Form::label('post_code', 'Post Code (Limit is 255 characters)') !!}
				{!! Form::text('post_code', null, ['class' => 'form-control', 
											  'placeholder' => "Enter your Postcode here (e.g. 4740)"]) !!}
				{!! $errors->first('post_code', '<span class="help-block">:message</span>') !!}
			</div>
			
			<div class="form-group {{ $errors->has('work_phone_number') ? 'has-error' : '' }}">
				{!! Form::label('work_phone_number', 'Work Phone Number (Limit is 255 characters)') !!}
				{!! Form::text('work_phone_number', null, ['class' => 'form-control', 
											  'placeholder' => "Enter the phone number of your business here. Please use only one number"]) !!}
				{!! $errors->first('work_phone_number', '<span class="help-block">:message</span>') !!}
			</div>
			
			<div class="form-group {{ $errors->has('mobile_phone_number') ? 'has-error' : '' }}">
				{!! Form::label('mobile_phone_number', 'Mobile Phone Number (Limit is 255 characters and Optional)') !!}
				{!! Form::text('mobile_phone_number', null, ['class' => 'form-control', 
											  'placeholder' => "Enter a mobile phone number so that we can contact you if needed"]) !!}
				{!! $errors->first('mobile_phone_number', '<span class="help-block">:message</span>') !!}
			</div>
			
			<div class="form-group {{ $errors->has('qualifications') ? 'has-error' : '' }}">
				{!! Form::label('description', 
								'Description of Supplier') !!}
				{!! Form::textarea('description', 
								    null, 
								  ['class' => 'form-control', 
								   'placeholder' => "Please tell us about your business"]) !!}
				{!! $errors->first('description', 
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
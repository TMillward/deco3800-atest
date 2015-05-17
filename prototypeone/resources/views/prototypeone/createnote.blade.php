@extends("prototypeone.template.master")

@section("title", "Create A Research Note")


@section("content")
	
	<h1>Create A New Research Note</h1>
	
	<div class="container">
		<h2>Enter your details here</h2>
		
		{!! Form::open(array('url' => route('create_note_check_path', [$user->user_id]), 'files' =>true)) !!}
		
			<div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
				{!! Form::label('title', 
								'Title (Limit is 255 Characters)') !!}
				{!! Form::text('title', 
								null, 
							  ['class' => 'form-control', 
							   'placeholder' => "Enter Title Of Note Here (e.g. My First Note)"]) !!}
				{!! $errors->first('title', 
								   '<span class="help-block">:message</span>') !!}
			</div>
			
			<div class="form-group {{ $errors->has('research_text') ? 'has-error' : '' }}">
				{!! Form::label('research_text', 
								'Research Text') !!}
				{!! Form::textarea('research_text', 
								    null, 
								  ['class' => 'form-control', 
								   'placeholder' => "Enter All Your Research Here"]) !!}
				{!! $errors->first('research_text', 
								   '<span class="help-block">:message</span>') !!}
			</div>
			<div class="images_fields_wrap">
				<div>{!! Form::file('image', ['name' => 'research_images[]']) !!}<a href="#" class="remove_field">remove</a></div> 
				<p class="add_image_button" >Add image</p></br>
			</div>	
			<div class="form-group">
				{!! Form::submit('Save Note', 
								['class' => 'btn btn-primary']) !!}
			</div>
			
		{!! Form::close() !!}
		
	</div>
	
	<div class="container">
		<p>{!! HTML::linkRoute('home_user_path', 
							   'Return to list of notes (Discards Current Note)', [$user->user_id]) !!}</p>
	</div>
	
@stop
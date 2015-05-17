@extends("prototypeone.template.master")

@section("title", "Edit A Research Note")

@section("content")
	<h1>Edit A New Research Note</h1>
	
	<div class="container">
		<h2>Change the details of your research note here</h2>
		
		{!! Form::model($note, ['url' => route('edit_check_path', [$user->user_id, $note->research_note_id]), 'method' => 'patch','files' =>true ] ) !!}
		
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
			
			<div id="images">
				<table class="table table-hover">
					<tr>
						<th>Image</th>
						<th>Date Added</th>
						<th>Remove</th>
					</tr>
					@for($i = 0; $i < count($images); $i++)
						<tr>
							
							<td><a href="/note_images/{{ $images[$i]->path }}">{{ $images[$i]->path }}</a></td><!-- preferable to have a route here instead to image-->
							<td>{{ $images[$i]->created_at }}</td>
							<td>Remove image</td><!--need some way to mark for deletion-->
						</tr>
					@endfor
					
				</table>
				<div class="images_fields_wrap">
					<button type="button" class="add_image_button" >Add image</button></br>
					<div>{!! Form::file('image', ['name' => 'research_images[]']) !!}<a href="#" class="remove_field">remove</a></div>
				</div>
			</div>
			<div class="form-group">
				{!! Form::submit('Save Note', 
								['class' => 'btn btn-primary']) !!}
			</div>
			
		{!! Form::close() !!}
		
	</div>
	
	<div class="container">
		<p>{!! HTML::linkRoute('home_user_path', 
							   'Return to list of notes (Discards any changes)', [$user->user_id]) !!}</p>
	</div>
	
@stop
@extends("prototypeone.template.master")

@section("title", "Delete Note")

@section("content")
	<div class="container">
		<h1>Your Research Note Is About To Be Deleted!</h1>
		<p>
		Are you sure you want to delete the note below? Please double-check 
		to ensure that you don't unintentionally delete this note. Deleted notes
		cannot be retrieved.
		</p>
		<p><strong>Title: </strong> {{ $note->title }} </p>
		<p>
		<strong>Research Text: </strong>  <br><br>
		{{ $note->research_text }} 
		</p> <br><br>
		<p><strong>Created At: </strong> {{ $note->created_at }} </p>
		<p><strong>Updated At: </strong> {{ $note->updated_at }} </p>
		{!! Form::open(['url' => route('delete_path_confirm', [$user->user_id, $note->research_note_id]), 
					    'method' => 'get']) !!}
			<div class="form-group">
				{!! Form::submit('Yes. I would like to delete this note', ['class' => 'btn btn-danger']) !!}
			</div>
		{!! Form::close() !!}
		{!! Form::open(['url' => route('home_user_path', [$user->user_id]), 
						'method' => 'get']) !!}
			<div class="form-group">
				{!! Form::submit('No. I would like to keep this note. Go back', ['class' => 'btn btn-primary']) !!}
			</div>
		{!! Form::close() !!}
	</div>
@stop



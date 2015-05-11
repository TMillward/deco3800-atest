@extends("prototypeone.template.master")

@section("title", "Research Note Info")

@section("content")
	
	<div class="container">
		<h1>Your note</h1>
		<p><strong>Title: </strong> {{ $note->title }} </p>
		<p>
		<strong>Research Text: </strong>  <br><br>
		{{ $note->research_text }} 
		</p> <br><br>
		<p><strong>Created At: </strong> {{ $note->created_at }} </p>
		<p><strong>Updated At: </strong> {{ $note->updated_at }} </p>
		{!! Form::open(['url' => route('submit_case', [$user->user_id, $note->research_note_id])]) !!}
			{!! Form::label('submitButton', 'Click here to submit this note for panel review: ') !!}
			{!! Form::submit('Submit', ['class' => 'btn btn-primary', 'name' => 'submitButton']) !!}
		{!! Form::close() !!}
	</div>
	
	<div class="container">
		<p>{!! HTML::linkRoute('home_user_path', 'Return to list of notes', [$user->user_id]) !!}</p>
	</div>
@stop



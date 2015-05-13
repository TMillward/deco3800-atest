@extends("prototypeone.template.master")

@section("title", "Submit Case For Review")
@section("content")
	<h1>Case Submission Successful</h1>
	<h2>Your Research Note Below Was Submitted For Review</h2>
	<p>
		<strong>Title:</strong>
		{{ $research_note_info->title }}
	</p>
	<p>
		<strong>Text:</strong>
		<br>
		<br>
		{{ $research_note_info->research_text }}
	</p>
	<br>
	<br>

	{!! Form::open(['url' => route('view_note_path', 
						[$user_id, 
						 $research_note_info->research_note_id]), 
					'method' => 'get']) !!}
		{!! Form::submit('Return to view this research note', 
						 ['class' => 'btn btn-primary']) !!}
	{!! Form::close() !!}
@stop

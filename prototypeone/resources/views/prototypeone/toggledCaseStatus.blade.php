@extends("prototypeone.template.master")

@section("title", "Note Creation Successful")

@section("content")
	<div class="container">

		@if ($case->status)
			<h1> You have resolved your case below! </h1>
			<h2> 
				You can generate a report (PDF) from your 
				case by clicking the link below and clicking the 
				green button. 
			</h2>
		@else
			<h1> You have unresolved your case below! </h1>
		@endif

		<p><strong>Title: </strong> {{ $research_note->title }} </p>
		<p>
		<strong>Research Text: </strong>  <br><br>
		{{ $research_note->research_text }} 
		</p> <br><br>
		<p><strong>Created At: </strong> {{ $research_note->created_at }} </p>
		<p><strong>Updated At: </strong> {{ $research_note->updated_at }} </p>

		
	</div>
	
	<div class="container">
		<p>
			{!! HTML::linkRoute('view_note_path', 
							   'Click Here To Return To The Research Note Page', 
							   [$user->user_id, $research_note->research_note_id]) 
			!!}
		</p>
	</div>
@stop



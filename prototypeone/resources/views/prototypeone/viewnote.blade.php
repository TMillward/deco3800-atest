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
	</div>
	
	<div class="container">
		<p>{!! HTML::linkRoute('home_user_path', 'Return to list of notes', [$user->user_id]) !!}</p>
	</div>
@stop



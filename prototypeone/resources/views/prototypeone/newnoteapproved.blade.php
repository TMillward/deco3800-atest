@extends("prototypeone.template.master")

@section("title", "Note Creation Successful")

@section("content")
	<div class="container">
		<h1>Your Research Note Has Been Successfully Created!</h1>
		<p>
		Your note has been successfully created with the following information:
		</p>
		<p><strong>Title: </strong> {{ $note->title }} </p>
		<p>
		<strong>Research Text: </strong>  <br><br>
		{{ $note->research_text }} 
		</p> <br><br>
		<p><strong>Created At: </strong> {{ $note->created_at }} </p>
		<p><strong>Updated At: </strong> {{ $note->updated_at }} </p>
	</div>
	
	<div class="container">
		<p>{!! HTML::linkRoute('home_user_path', 
							   'Click Here To Return To List Of Notes', [$user->user_id]) !!}</p>
	</div>
@stop



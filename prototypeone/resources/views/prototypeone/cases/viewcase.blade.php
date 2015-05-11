@extends("prototypeone.template.case")

@section("title", "Case Notes")
@section("content")
	<p>{{$case_notes->title}}</p></br>
	<p>{{$user_id}}</p></br>
	<p>{{$case_notes->research_text}}</p>
	
@stop
@section("message_feed")
	@foreach($messages as $message)
	<!--display each message-->
		<div> 
			<p class="user_name"> {{$message->user_id}}</p> <!--TODOquery DB for actual name-->
			<p class="message_timestamp"> {{$message->created_at}}</p>
			<p class="message_text"> {{$message->message}}</p>
		</div>
	@endforeach
@stop

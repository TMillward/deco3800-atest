@extends("prototypeone.template.case")

@section("title", "Case Notes")
@section("content")
	<h1> Case: {{ $research_note->title }} </h1>
	<p>
		<strong>User: </strong> {{ $user->username }}
	</p>
	<p>
		<strong>Title: </strong> {{ $research_note->title }}
	</p>
	<p>
		<strong>Text: </strong> 
		<br>
		<br>
		{{ $research_note->research_text }} 
	</p>
	<p>
		{!! HTML::linkRoute('view_cases', 
			'Click here to link back to the list of cases', 
			[$user_id]) 
		!!}
	</p>
@stop

@section("message_feed")
	<div class="container">
		<h2>Messages: </h2>
		<table class="table table-hover">
			<tr>
				<th>Message Content</th>
				<th>Date Created</th>
				<th>Date Modified</th>
			</tr>
			@foreach($messages as $message)
				<tr>
					<td>{{ $message->message }}</td>
					<td>{{ $message->created_at }}</td>
					<td>{{ $message->updated_at }}</td>
				</tr>
			@endforeach
		</table>
		<h2>Send a message below</h2>
		{!! Form::open(['url' => route('send_message', 
			[$user_id, $case_id])]) !!}
			<div class="form-group 
				{{ $errors->has('message_text') ? 'has-error' : '' }}">

				{!! Form::label('message_text', 'Message Text') !!}
				{!! Form::textarea('message_text', null, 
					['class' => 'form-control', 
					 'placeholder' => "Enter Your Message Here"]) !!}
				{!! $errors->first('message_text', 

								   '<span class="help-block">:message</span>') !!}

			</div>

			<div class="form-group">
				{!! Form::submit('Send a message', 
					['class' => 'btn btn-primary']) !!}
			</div>
		{!! Form::close() !!}
@stop


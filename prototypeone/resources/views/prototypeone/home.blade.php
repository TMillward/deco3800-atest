@extends("prototypeone.template.master")

@section("title", "Welcome Page")

@section("content")
	<div class="container">
		<h1>Welcome {{ $user->name }}</h1>
		<h2>Personal Info </h2>
		<p><strong>Username: </strong> {{ $user->username }} </p>
		<p><strong>Email: </strong> {{ $user->email }} </p>
		<p><strong>Created At: </strong> {{ $user->created_at }} </p>
		<p><strong>Updated At: </strong> {{ $user->updated_at }} </p>
		@if ($user->usertype === "Professional" || $user->usertype === "Expert User")
			@if ($user->usertype === "Professional")
				<p><strong>Title: </strong> {{ $extrainfo->title}} </p>
				<p><strong>About: </strong> {{ $extrainfo->about}} </p>
			@elseif ($user->usertype === "Expert User")
				<p><strong>You are an Expert User!</strong></p>
			@endif
			<p><strong>Qualifications: </strong> {{ $extrainfo->qualifications}} </p>
			<div>{!! HTML::linkRoute('view_cases', 'view cases', [$user->user_id]) !!}</div>
		@elseif ($user->usertype === "Supplier")
			<p><strong>Street Number: </strong> {{ $extrainfo->street_number}} </p>
			<p><strong>Street Name: </strong> {{ $extrainfo->street_name}} </p>
			<p><strong>Suburb: </strong> {{ $extrainfo->suburb}} </p>
			<p><strong>State: </strong> {{ $extrainfo->state}} </p>
			<p><strong>Post Code: </strong> {{ $extrainfo->post_code}} </p>
			<p><strong>Work Phone Number: </strong> {{ $extrainfo->work_phone_number}} </p>
			<p><strong>Mobile Phone Number: </strong> {{ $extrainfo->mobile_phone_number}} </p>
			<p><strong>Description: </strong> {{ $extrainfo->description}} </p>
			
		@endif
		<div class="container">
			{!! Form::open(['route' => 'logout_path', 
							'method' => 'get']) !!}
				<div class="form-group">
					{!! Form::submit('Log out', ['class' => 'btn btn-danger']) !!}
				</div>
			{!! Form::close() !!}
		</div>
		
	</div>
	
	@if ($user->usertype === "Seeker")
		<div class="container">
			<p>Research Notes: </p>
			<table class="table table-hover">
				<tr>
					<th>Research Note Id</th>
					<th>Title</th>
					<th>Date Created</th>
					<th>Date Updated</th>
					<th>Click Here To Edit</th>
					<th>Click Here to Delete</th>
				</tr>
				@foreach ($research_notes as $note)
					<tr>
						<td>{{ $note->research_note_id }}</td>
						<td>{!! HTML::linkRoute('view_note_path', 
												$note->title, 
											   [$user->user_id, 
												$note->research_note_id]) !!}</td>
						<td>{{ $note->created_at }}</td>
						<td>{{ $note->updated_at }}</td>
						<td>
							{!! Form::open(['url' => route('edit_path', [$user->user_id, $note->research_note_id]), 
											'method' => 'get']) !!}
								<div class="form-group">
									{!! Form::submit('Edit', ['class' => 'btn btn-primary']) !!}
								</div>
							{!! Form::close() !!}
						</td>
						<td>
							{!! Form::open(['url' => route('delete_path', [$user->user_id, $note->research_note_id]), 
											'method' => 'get']) !!}
								<div class="form-group">
									{!! Form::submit('Delete', 
													['class' => 'btn btn-danger']) !!}
								</div>
							{!! Form::close() !!}
						</td>
					</tr>
				@endforeach
			</table>
			
			<div class="container">
				{!! Form::open(['url' => route('create_note_path', [$user->user_id]), 
								'method' => 'get']) !!}
					<div class="form-group">
						{!! Form::submit('Create A New Note', ['class' => 'btn btn-primary']) !!}
					</div>
				{!! Form::close() !!}
			</div>
		</div>
	@endif
@stop



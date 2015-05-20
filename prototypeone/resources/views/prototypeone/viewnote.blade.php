@extends("prototypeone.template.master")

@section("title", "Research Note Info")

@section("content")
	
	<div class="container">
		<h1>Your note</h1>
		<p><strong>Title: </strong> {{ $note->title }} </p>
		<p>
		<strong>Research Text: </strong>  <br><br>
		{{ $note->research_text }} 
		</p>

		<div id="images">
			@if ($images->count() != 0)
				<table class="table table-hover">
					<tr>
						<th>Image</th>
						<th>Date Added</th>
					</tr>
					@foreach($images as $image)
						<tr>
							<td>{!! HTML::link("note_images/{$image->path}", $image->path) !!}</td><!-- preferable to have a route here instead to image-->
							<td>{{ $image->created_at }}</td>
						</tr>
					@endforeach
				</table>
			@endif
		</div>
		<br><br>
		<p><strong>Created At: </strong> {{ $note->created_at }} </p>
		<p><strong>Updated At: </strong> {{ $note->updated_at }} </p>
		@if ($isCase === null)
			<p>
				<strong>Review Status: </strong>
				This note has not been submitted yet. 
				Click the button below to submit it 
				for review by our panel: 
			</p>
			{!! Form::open(['url' => route('submit_case', 
									[$user->user_id, 
									$note->research_note_id])]) !!}
				{!! Form::submit('Submit', 
				['class' => 'btn btn-primary', 
				 'name' => 'submitButton']) !!}
			{!! Form::close() !!}
		@else
			@if ($isCase->status)
				<p>
					This case has been resolved. If you 
					would like it to be unresolved, please 
					click the button below
				</p>
				{!! Form::open(['url' => route('toggle_case_resolution')]) !!}
					 {!! Form::hidden('case_id', $isCase->case_id) !!}
					 {!! Form::submit('Unresolve This Case', 
					 ['class' => 'btn btn-primary', 
					  'name' => 'submitButton']) !!}
				{!! Form::close() !!}

				<p>
					You can generate a PDF report of this research note 
					by clicking the button below.
				</p>

				{!! Form::open(['url' => route('generate_report'), 
								'target' => "_blank"]) !!}
					{!! Form::hidden('note_id', $note->research_note_id) !!}
					{!! Form::submit('Generate Report', 
					['class' => 'btn btn-success', 
					 'name' => 'submitButton']) !!}
				{!! Form::close() !!}
			@else
				<p>
					<strong>Review Status: </strong> 

					{!! HTML::linkRoute('get_case_page', 
					'This research note is pending review. Click here 
					to look at its progress.', 
					[$user->user_id, $isCase->case_id]) !!} 

					This case is not yet resolved. If you would like to 
					resolve it, please click the button below.
				</p>
				{!! Form::open(['url' => route('toggle_case_resolution')]) !!}
					 {!! Form::hidden('case_id', $isCase->case_id) !!}
					 {!! Form::submit('Resolve This Case', 
					 ['class' => 'btn btn-primary', 
					  'name' => 'submitButton'])!!}
				{!! Form::close() !!}
			@endif
		@endif
	</div>

	<br>
	<br>
	
	<div class="container">
		{!! Form::open(['url' => route('home_user_path', [$user->user_id]), 
						'method' => 'get']) !!}
			{!! Form::submit('Return to list of notes', 
							['class' => 'btn btn-primary']) !!}
		{!! Form::close() !!}
	</div>
@stop



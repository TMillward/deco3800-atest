@extends("prototypeone.template.master")

@section("title", "Note Edit Successful")

@section("content")
	<div class="container">
		<h1>Your Research Note Has Been Successfully Edited!</h1>
		<p>
		Your note has been successfully edited with the following information:
		</p>
		<p><strong>Title: </strong> {{ $note->title }} </p>
		<p>
		<strong>Research Text: </strong>  <br><br>
		{{ $note->research_text }} 
		</p> <br><br>
		<p><strong>Created At: </strong> {{ $note->created_at }} </p>
		<p><strong>Updated At: </strong> {{ $note->updated_at }} </p>
	</div>

	<div id="images">
			<table class="table table-hover">
				<tr>
					<th>Image</th>
					<th>Date Added</th>
				</tr>
				
				@foreach($images as $image)
					<tr>
						<td><a href="/note_images/{{ $image->path }}">{{ $image->path }}</a></td>
						<td>{{ $image->created_at }}</td>
					</tr>
				@endforeach
			</table>
	</div>
	
	<div class="container">
		<p>{!! HTML::linkRoute('home_user_path', 
							   'Click Here To Return To List Of Notes', [$user->user_id]) !!}</p>
	</div>
@stop



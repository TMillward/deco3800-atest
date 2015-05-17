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
	<div id="images">
			<table class="table table-hover">
				<tr>
					<th>Image</th>
					<th>Date Added</th>
				</tr>
				
				@foreach($images as $image)
					<tr>
						<td><a href="#">{{ $image->path }}</a></td><!-- preferable to have a route here instead to image-->
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



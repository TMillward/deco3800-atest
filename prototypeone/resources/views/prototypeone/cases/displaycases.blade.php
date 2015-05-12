@extends("prototypeone.template.master")
@section("title", "Cases")

@section("content")
	<h1> Currently Active Research Cases </h1>
	<p> 
		Below are the cases currently pending your review. Please 
		click the title of any of the cases below to start or 
		continue your review
	</p>
	<h2>Cases for review: </h2>
	<table class="table table-hover">
		<tr>
			<th>Case Title</th>
			<th>Date Created</th>
			<th>Date Updated</th>
		</tr>
		@for ($i = 0; $i < $numberOfCases; ++$i)
			<tr>
				<td>
				{!! HTML::linkRoute(
						'get_case_page', 
						$cases[$i]->title, 
						[$user_id, $caseInfo[$i]->case_id]
					) 
				!!}
				</td>
				<td>
					{{ $cases[$i]->created_at }}
				</td>
				<td>
					{{ $cases[$i]->updated_at }}
				</td>
			</tr>
		@endfor
	</table>
	<p>
		{!! HTML::linkRoute('home_user_path', 
			'Click here to link back to your home page', 
			[$user_id]) 
		!!}
	</p>
@stop
@extends("prototypeone.template.master")
@section("title", "Cases")

@section("content")
<<<<<<< HEAD
	@for($i = 0; $i < count($cases); $i++)<!-- are actually notes for acces to users and titles-->
		<div class="case link">
			<!--cases display-->
			<p> {{$cases[$i]->user_id}}</p>
			<p> {{$cases[$i]->title}}</p>
			{!! HTML::linkRoute('get_case_page', 'view case', [$user_id, $case_info[$i]->case_id]) !!}	
		</div>
	

	@endfor
=======
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
>>>>>>> 9cc930b88c53f1b46f54c3f2c84686b2c5770400
@stop
@extends("prototypeone.template.master")
@section("title", "Cases")

@section("content")
	<h1> Currently Active Research Cases </h1>
	<p> 
		Below are the cases currently pending your review. Please 
		click the title of any of the cases below to start or 
		continue your review
	</p>
	@for ($i = 0; $i < $numberOfCases; ++$i)
		<h2>{{ $cases[$i]->title }}</h2>
		<p>
			{!! HTML::linkRoute(
				'get_case_page', 
				'Click here to go to the review page for this case', 
				[$user_id, $caseInfo[$i]->case_id]
				)
			!!}
		</p>
	@endfor
	<p>
		{!! HTML::linkRoute('home_user_path', 
			'Click here to link back to your home page', 
			[$user_id]) 
		!!}
	</p>
@stop
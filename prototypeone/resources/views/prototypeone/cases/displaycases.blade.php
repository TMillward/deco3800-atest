@extends("prototypeone.template.master")
@section("title", "Cases")

@section("content")
	@for($i = 0; $i < count($cases); $i++)<!-- are actually notes for acces to users and titles-->
		<div class="case link">
			<!--cases display-->
			<p> {{$cases[$i]->user_id}}</p>
			<p> {{$cases[$i]->title}}</p>
			{!! HTML::linkRoute('get_case_page', 'view case', [$user_id, $case_info[$i]->case_id]) !!}	
		</div>
	

	@endfor
@stop
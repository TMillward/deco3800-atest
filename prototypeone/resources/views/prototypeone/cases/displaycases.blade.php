@extends("prototypes.template.master")
@section("title", "Cases")

@section("content")
	@foreach($cases as $case)<!-- are actually notes for acces to users and titles-->
		<div>
			<!--cases display-->
			<p> {{$case->user_id}}</p>
			<p> {{$case->title}}</p>
		</div>
	@endforeach
@stop
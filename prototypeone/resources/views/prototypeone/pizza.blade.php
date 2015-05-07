@extends("prototypeone.template.master")

@section("title", "Pizza Page")

@section("content")

	<h1> Here's some pizza </h1>

	@if (2 == 2)
		<p>2 is equal to 2</p>
	@else
		<p>2 is not equal to 2</p>
	@endif

@stop

@extends("prototypeone.template.master")

@section("title", "About This Prototype")

@section("content")
	<div class="container">
		<h1>About This Prototype</h1>
		<p>
		This is the prototype for the Sprint Zero presentation. This took a lot of work to get setup over the 'break'. 
		Please give us a good mark for this
		</p>
	</div>
	
	<div class="container">
		<p>{!! HTML::link(".", "Back to login page") !!}</p>
	</div>
@stop



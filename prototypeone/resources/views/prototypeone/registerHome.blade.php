@extends("prototypeone.template.master")

@section("title", "Select User Type")

@section("content")
	<h1> Please select what kind of account you would like to create </h1>
	
	{!! HTML::linkRoute('seeker_register', 'AT Seeker') !!} <br>
	{!! HTML::linkRoute('professional_register', 'AT Professional') !!} <br>
	{!! HTML::linkRoute('supplier_register', 'AT Supplier') !!} <br>
	{!! HTML::linkRoute('expert_user_register', 'AT Expert User') !!} <br>
	
	<br>
	<br>
	<p>{!! HTML::link(".", "Back to the login page") !!}</p>

@stop
@extends("prototypeone.template.master")

@section("title", "Select User Type")

@section("content")
	<h1> Please select what kind of account you would like to create </h1>
	{!! HTML::ul(
		array(
			HTML::linkRoute('seeker_register', 'AT Seeker'),
			HTML::linkRoute('professional_register', 'AT Professional'),
			HTML::linkRoute('supplier_register', 'AT Supplier'),
			HTML::linkRoute('expert_user_register', 
					'AT Expert User'),
		))
	!!}
	<ul>
		<li>
			{!! HTML::linkRoute('seeker_register', 
				'AT Seeker') 
			!!}
		</li>
		<li>
			{!! HTML::linkRoute('professional_register', 
				'AT Professional') 
			!!}
		</li>
		<li>
			{!! HTML::linkRoute('supplier_register', 
				'AT Supplier') 
			!!}
		</li>
		<li>
			{!! HTML::linkRoute('expert_user_register', 
				'AT Expert User') 
			!!} 
		</li>
	</ul>
	
	<p>{!! HTML::link(".", "Back to the login page") !!}</p>

@stop
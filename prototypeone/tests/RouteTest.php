<?php

/**
* These are tests checking that all the routes are accessible and 
* load properly
* - Written: 9th of May, 2015
* - Written by: Joshua Rillera
*/
class RouteTest extends TestCase {

	/**
	* Check that loading the index page results in 
	* a 200 status (Loaded Correctly)
	*
	* @return void
	*/
	public function testIndexResponse() {
		// The response
		$response = $this->call("GET", "/");

		// We should get 200 as a status
		$this->assertEquals(200, $response->getStatusCode());
	}

	/**
	* Check that loading the about page results in 
	* a 200 status (Loaded Correctly)
	*
	* @return void
	*/
	public function testAboutResponse () {
		// The response
		$response = $this->call("GET", "/about");

		// We should get 200 as a status
		$this->assertEquals(200, $response->getStatusCode());
	}

	/**
	* Check that loading the unauthorized user 
	* page results in a 200 status (Loaded Correctly)
	*
	* @return void
	*/
	public function testUnauthorizedUserResponse () {
		// The response
		$response = $this->call("GET", "/home");

		// We should get 200 as a status
		$this->assertEquals(200, $response->getStatusCode());
	}

	/**
	* Check that loading register pages 
	* results in a 200 status (Loaded Correctly)
	*
	* @return void
	*/
	public function testRegisterResponse () {
		// The response for the register home page
		$homeResponse = $this->call("GET", "/register");

		// The response for the seeker form
		$seekerResponse = $this->call("GET", "/register/seeker");

		// The response for the professional form
		$professionalResponse 
			= $this->call("GET", "/register/professional");		

		// The response for the seeker form
		$supplierResponse = $this->call("GET", "/register/supplier");

		// We should get 200 as a status for all responses
		$this->assertEquals(200, $homeResponse->getStatusCode());
		$this->assertEquals(200, $seekerResponse->getStatusCode());
		$this->assertEquals(200, $professionalResponse->getStatusCode());
		$this->assertEquals(200, $supplierResponse->getStatusCode());

	}

	/**
	* Check that loading the newAccount post page 
	* (when trying to register as a seeker) results in 
	* a redirect to the seeker register form
	*
	* @return void
	*/
	public function testSeekerNewAccountFailedResponse () {

		// Go to seeker register form first
		$this->call("GET", "/register/seeker");
		Session::start(); // Need to start a session

		// The content to pass as a post request. This is 
		// for a standard seeker page
		$postRequest = array(
				'_token' => csrf_token(),
				'username' => '',
				'name' => '',
				'email' => '',
				'password' => '',
				'usertype' => "Seeker"
		);

		// The response for the new account post page
		$newAccountResponse = $this->call("POST", 
			"newAccount", 
			$postRequest);

		// We should have an error - 302
		// Because we should be redirected
		$this->assertEquals(302, $newAccountResponse->getStatusCode());

		// We have to be redirected to the register form for a 
		// Seeker
		$this->assertRedirectedToRoute("seeker_register");

		// We should have errors
		$this->assertSessionHasErrors();
	}

	/**
	* Check that loading the newAccount post page 
	* (when trying to register as a professional) results in 
	* a redirect to the professional register form
	*
	* @return void
	*/
	public function testProfessionalNewAccountFailedResponse () {

		// Go to professional register form first
		$this->call("GET", "/register/professional");
		Session::start(); // Need to start a session

		// The content to pass as a post request. This is 
		// for a standard professional page
		$postRequest = array(
				'_token' => csrf_token(),
				'username' => '',
				'name' => '',
				'email' => '',
				'password' => '',
				'usertype' => "Seeker"
		);

		// The response for the new account post page
		$newAccountResponse = $this->call("POST", 
			"newAccount", 
			$postRequest);

		// We should have an error - 302
		// Because we should be redirected
		$this->assertEquals(302, $newAccountResponse->getStatusCode());

		// We have to be redirected to the register form for a 
		// Seeker
		$this->assertRedirectedToRoute("professional_register");

		// We should have errors
		$this->assertSessionHasErrors();
	}

	/**
	* Check that loading the newAccount post page 
	* (when trying to register as a supplier) results in 
	* a redirect to the supplier register form
	*
	* @return void
	*/
	public function testSupplierNewAccountFailedResponse () {

		// Go to supplier register form first
		$this->call("GET", "/register/supplier");
		Session::start(); // Need to start a session

		// The content to pass as a post request. This is 
		// for a standard supplier page
		$postRequest = array(
				'_token' => csrf_token(),
				'username' => '',
				'name' => '',
				'email' => '',
				'password' => '',
				'usertype' => "Seeker"
		);

		// The response for the new account post page
		$newAccountResponse = $this->call("POST", 
			"newAccount", 
			$postRequest);

		// We should have an error - 302
		// Because we should be redirected
		$this->assertEquals(302, $newAccountResponse->getStatusCode());

		// We have to be redirected to the register form for a 
		// Seeker
		$this->assertRedirectedToRoute("supplier_register");

		// We should have errors
		$this->assertSessionHasErrors();
	}

}

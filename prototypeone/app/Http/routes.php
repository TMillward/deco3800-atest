<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// Index Route - Home Page
Route::get("/", 
		   ['as' => 'index_path', 			
			'uses' => "PrototypeOneController@index"]);


// Login Route - Handling Login
Route::post("login", 
			['as' => 'login_path', 			
             'uses' => "PrototypeOneController@login"]);
// Home Route - Home page of a user
Route::get("home/{user_id}", 
		   ['as' => 'home_user_path', 
			'uses' => "PrototypeOneController@homeUser"]);

// Create Note Route - Create a research note
Route::get("home/{user_id}/create_note", 
		   ['as' => 'create_note_path',
			'uses' => "PrototypeOneController@createNote"]);

// New Note Validation Route - Validate inputs given for a route
Route::post("home/{user_id}/create_note/check/", 
			['as' => 'create_note_check_path', 
			 'uses' => "PrototypeOneController@createNoteCheck"]);

// View Case Route - Display research notes sent for review
Route::get("home/{user_id}/cases", 
		   ['as' => 'view_cases', 
		    'uses' => "PrototypeOneController@getCases"]);

// Submit Message Route - Submit a message for a particular case
Route::post("home/{user_id}/cases/{case_id}/submitMessage", 
		   ['as' => 'send_message', 
			'uses' => "PrototypeOneController@submitMessage"]);

// Get Case Route - Gets the page of a particular case
Route::get("home/{user_id}/cases/{case_id}", 
		   ['as' => 'get_case_page', 
		    'uses' => "PrototypeOneController@getCasePage"]);

// View Note Route - View a particular research note
Route::get("home/{user_id}/{research_note_id}", 
		   ['as' => 'view_note_path', 		
			'uses' => "PrototypeOneController@viewNote"]);

// Edit Note Route - Edit a particular research note
Route::get("home/{user_id}/{research_note_id}/edit", 
		   ['as' => 'edit_path',				
			'uses' => "PrototypeOneController@editNote"]);

// Edit Note Validation Route - Validate edit on a research note
Route::patch("home/{user_id}/{research_note_id}/edit/check", 
			 ['as' => 'edit_check_path', 		
			  'uses' => "PrototypeOneController@editNoteCheck"]);

// Delete Note Route - Delete a research note
Route::get("home/{user_id}/{research_note_id}/delete", 
		   ['as' => 'delete_path',			
			'uses' => "PrototypeOneController@deleteNote"]);

// Delete Note Validation Route - Confirm that note is to be deleted
Route::get("home/{user_id}/{research_note_id}/delete/confirm", 
		   ['as' => 'delete_path_confirm', 
			'uses' => "PrototypeOneController@deleteNoteConfirm"]);

// Submit Case Route - Submit a note for panel review
Route::post("home/{user_id}/{research_note_id}/submitCase", 
		    ['as' => 'submit_case', 
			 'uses' => "PrototypeOneController@submitCase"]);

// No user route - A page where a user is redirected to if they are 
// not logged in
Route::get("home", 
		   ['as' => 'home_no_user_path', 		
			'uses' => "PrototypeOneController@homeNoUser"]);

// Logout route - Logout user
Route::get("logout", 
		   ['as' => 'logout_path', 			
			'uses' => "PrototypeOneController@logout"]);

// About route - About page of this web app
Route::get("about", 
		   ['as' => 'about_path', 			
			'uses' => "PrototypeOneController@about"]);

// Register route - List of possible accounts to register
Route::get("register", 
		   ['as' => 'register_path', 			
			'uses' => "PrototypeOneController@registerHome"]);

// Register Seeker route - Form for registering a seeker
Route::get("register/seeker", 
		   ['as' => 'seeker_register', 
			'uses' => 'PrototypeOneController@seekerRegister']);

// Register Professional route - Form for registering a professional
Route::get("register/professional", 
		   ['as' => 'professional_register', 
			'uses' => 'PrototypeOneController@professionalRegister']);

// Register Supplier route - Form for registering a supplier
Route::get("register/supplier", 
		   ['as' => 'supplier_register', 
			'uses' => 'PrototypeOneController@supplierRegister']);

// Register Expert User route - Form for registering an expert user
Route::get("register/expert_user", 
		   ['as' => 'expert_user_register', 
			'uses' => 'PrototypeOneController@expertUserRegister']);

// New Account Route - Validate forms used to create an account
Route::post("newAccount", 
		    ['as' => 'newaccount_path', 		
			 'uses' => "PrototypeOneController@newAccount"]);

// Toggle Resolution Route - Toggles the status of a case between 
// resolved and unresolved
Route::post("toggleResolution", 
			['as' => 'toggle_case_resolution', 
			 'uses' => "PrototypeOneController@toggleResolution"]);

// Generate Report Route - Generates report using info given
Route::post("generateReport", 
			['as' => 'generate_report', 
			 'uses' => "PrototypeOneController@generateReport"]);

/**
* Routes used for testing
*/

// Route for testing PDF
Route::get("testPDF", 
		   ['as' => 'testFirstPDF_path', 
		    'uses' => 'PrototypeOneController@testFirstPDF']);


// Easter eggs for people
Route::get("pizza", "PrototypeOneController@pizza");

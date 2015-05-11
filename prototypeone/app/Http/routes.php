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


Route::get("/", [ 'as' => 'index_path', 			
				  'uses' => "PrototypeOneController@index"]);
Route::post("login", [ 'as' => 'login_path', 			
                       'uses' => "PrototypeOneController@login"]);
Route::get("home/{user_id}", [ 'as' => 'home_user_path', 
							   'uses' => "PrototypeOneController@homeUser"]);
Route::get("home/{user_id}/create_note", [ 'as' => 'create_note_path',
										   'uses' => "PrototypeOneController@createNote"]);
Route::post("home/{user_id}/create_note/check", [ 'as' => 'create_note_check_path', 
												  'uses' => "PrototypeOneController@createNoteCheck"]);
Route::get("/home/{user_id}/cases", ['as' => 'view_cases', 'uses' => "PrototypeOneController@getCases"]);
Route::get("home/{user_id}/{research_note_id}", [ 'as' => 'view_note_path', 		
												  'uses' => "PrototypeOneController@viewNote"]);
Route::get("home/{user_id}/{research_note_id}/edit", [ 'as' => 'edit_path',				
													   'uses' => "PrototypeOneController@editNote"]);
Route::patch("home/{user_id}/{research_note_id}/edit/check", [ 'as' => 'edit_check_path', 		
															   'uses' => "PrototypeOneController@editNoteCheck"]);
Route::get("home/{user_id}/{research_note_id}/delete", [ 'as' => 'delete_path',			
														 'uses' => "PrototypeOneController@deleteNoteCheck"]);
Route::get("home/{user_id}/{research_note_id}/delete/confirm", [ 'as' => 'delete_path_confirm', 
																 'uses' => "PrototypeOneController@deleteNoteConfirm"]);
Route::get("home", [ 'as' => 'home_no_user_path', 		
					 'uses' => "PrototypeOneController@homeNoUser"]);
Route::get("logout", [ 'as' => 'logout_path', 			
					   'uses' => "PrototypeOneController@logout"]);
Route::get("about", [ 'as' => 'about_path', 			
					  'uses' => "PrototypeOneController@about"]);
Route::get("register", [ 'as' => 'register_path', 			
						 'uses' => "PrototypeOneController@registerHome"]);
Route::get("register/seeker", [ 'as' => 'seeker_register', 
								'uses' => 'PrototypeOneController@seekerRegister']);
Route::get("register/professional", [ 'as' => 'professional_register', 
								'uses' => 'PrototypeOneController@professionalRegister']);
Route::get("register/supplier", [ 'as' => 'supplier_register', 
								'uses' => 'PrototypeOneController@supplierRegister']);			
Route::post("newAccount", [ 'as' => 'newaccount_path', 		
						    'uses' => "PrototypeOneController@newAccount"]);
//for cases 
Route::post("/home/{user_id}/{research_note_id}/submitCase", [ 'as' => 'submit_case', 
								'uses' => "PrototypeOneController@submitCase"]);							

Route::get("cases/{case_id}", ['as' => 'get_case_page', 'uses' => "PrototypeOneController@getCasePage"]);
//for messages
Route::post("cases/sendMessage", ['as' => 'submit_message', 'uses' => "PrototypeOneController@submitMessage"]);



Route::get("pizza", "PrototypeOneController@pizza");

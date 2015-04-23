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
							   'uses' => "PrototypeOneController@homeuser"]);
Route::get("home/{user_id}/create_note", [ 'as' => 'create_note_path',
										   'uses' => "PrototypeOneController@createnote"]);
Route::post("home/{user_id}/create_note/check", [ 'as' => 'create_note_check_path', 
												  'uses' => "PrototypeOneController@createnotecheck"]);
Route::get("home/{user_id}/{research_note_id}", [ 'as' => 'view_note_path', 		
												  'uses' => "PrototypeOneController@viewnote"]);
Route::get("home/{user_id}/{research_note_id}/edit", [ 'as' => 'edit_path',				
													   'uses' => "PrototypeOneController@editnote"]);
Route::patch("home/{user_id}/{research_note_id}/edit/check", [ 'as' => 'edit_check_path', 		
															   'uses' => "PrototypeOneController@editnotecheck"]);
Route::get("home/{user_id}/{research_note_id}/delete", [ 'as' => 'delete_path',			
														 'uses' => "PrototypeOneController@deletenote"]);
Route::get("home/{user_id}/{research_note_id}/delete/confirm", [ 'as' => 'delete_path_confirm', 
																 'uses' => "PrototypeOneController@deletenoteconfirm"]);
Route::get("home", [ 'as' => 'home_no_user_path', 		
					 'uses' => "PrototypeOneController@homenouser"]);
Route::get("logout", [ 'as' => 'logout_path', 			
					   'uses' => "PrototypeOneController@logout"]);
Route::get("about", [ 'as' => 'about_path', 			
					  'uses' => "PrototypeOneController@about"]);
Route::get("register", [ 'as' => 'register_path', 			
						 'uses' => "PrototypeOneController@register"]);
Route::post("newaccount", [ 'as' => 'newaccount_path', 		
						    'uses' => "PrototypeOneController@newaccount"]);

Route::get("pizza", "PrototypeOneController@pizza");

<?php namespace App;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Message extends Eloquent {
	/**
	* The database table used by the model
	*/
	protected $table = 'messages';
	
	/**
	* Primary Key
	*/
	protected $primaryKey = 'message_id';
	
	/**
	* Fillable values
	*/
	protected $fillable = ['case_id', 'user_id', 'message'];
}
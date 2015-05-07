<?php namespace App;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Supplier extends Eloquent {
	/**
	* The database table used by the model
	*/
	protected $table = 'suppliers';
	
	/**
	* Primary Key
	*/
	protected $primaryKey = 'supplier_id';
	
	/**
	* Fillable values
	*/
	protected $fillable = ['street_number', 'street_name', 'suburb', 'state', 
						   'post_code', 'work_phone_number', 'mobile_phone_number', 
						   'description'];
	
	/**
	* Hidden attributes - none so far unless deemed necessary
	*/
}
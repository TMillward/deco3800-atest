<?php namespace App;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Professional extends Eloquent {
	/**
	* The database table used by the model
	*/
	protected $table = 'professionals';
	
	/**
	* Primary Key
	*/
	protected $primaryKey = 'professional_id';
	
	/**
	* Fillable values
	*/
	protected $fillable = ['title', 'about', 'qualifications'];
	
	/**
	* Hidden attributes - No hidden attributes so far for this model
	*/
}
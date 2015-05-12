<?php namespace App;

use Illuminate\Database\Eloquent\Model as Eloquent;

class ExpertUser extends Eloquent {
	/**
	* The database table used by the model
	*/
	protected $table = 'expert_users';
	
	/**
	* Primary Key
	*/
	protected $primaryKey = 'expert_user_id';
	
	/**
	* Fillable values
	*/
	protected $fillable = ['qualifications'];
	
	/**
	* Hidden attributes - No hidden attributes so far for this model
	*/
}
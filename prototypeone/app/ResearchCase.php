<?php namespace App;

use Illuminate\Database\Eloquent\Model as Eloquent;

class ResearchCase extends Eloquent {
	/**
	* The database table used by the model
	*/
	protected $table = 'research_case';
	
	/**
	* Primary Key
	*/
	protected $primaryKey = 'case_id';
	
	/**
	* Fillable values
	*/
	protected $fillable = ['research_note_id','status'];
}
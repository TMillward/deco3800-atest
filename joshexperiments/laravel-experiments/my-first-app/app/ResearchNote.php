<?php namespace App;

use Illuminate\Database\Eloquent\Model as Eloquent;

class ResearchNote extends Eloquent {
	/**
	* The database table used by the model
	*/
	protected $table = 'research_notes';
	
	/**
	* Primary Key
	*/
	protected $primaryKey = 'research_note_id';
	
	/**
	* Fillable values
	*/
	protected $fillable = ['title', 'research_text'];
	
	/**
	* Hidden attributes
	*/
	protected $hidden = ['user_id', 'slug'];
}
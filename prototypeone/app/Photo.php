<?php namespace App;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Photo extends Eloquent {
	/**
	* The database table used by the model
	*/
	protected $table = 'images';
	
	/**
	* Primary key
	* Path is unique due to the file system not allowing two
	* different files with identical paths.
	*/
	protected $primaryKey = 'path';
	
	/**
	* Fillable values
	*/
	protected $fillable = ['research_note_id', 'path', 'dir', 'name'];
	/**
	* Hidden fields
	*/
	protected $hidden = ['created_at', 'updated_at', 'deleted_at'];
}
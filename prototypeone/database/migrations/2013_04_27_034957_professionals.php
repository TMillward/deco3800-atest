<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Professionals extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('professionals', function(Blueprint $table) {
			$table->increments('professional_id');
			$table->string('title')
				  ->nullable();
			$table->text('about')
				  ->nullable();
			$table->text('qualifications')
				  ->nullable();
			// $table->string('profile_picture_path'); - Path to profile picture
			// $table->???('specialties') - Specialties of this professional - for panel purposes
			$table->timestamps();
		});
		
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('professionals');
	}

}

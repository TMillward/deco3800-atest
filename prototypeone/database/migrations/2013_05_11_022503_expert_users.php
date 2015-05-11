<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ExpertUsers extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('expert_users', function(Blueprint $table) {
			$table->increments('expert_user_id'); // ID of expert user
			$table->text('qualifications')
				  ->nullable(); // Qualifications of expert user
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
		Schema::drop('expert_users');
	}

}

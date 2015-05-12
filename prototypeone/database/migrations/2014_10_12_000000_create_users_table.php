<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->increments('user_id');
			$table->string('username', 32)
				  ->unique();
			$table->string('name');
			$table->string('email')
				  ->nullable();
			$table->string('password', 60);
			$table->string('usertype', 32);
			$table->integer('professional_id')
				  ->unsigned();
			$table->foreign('professional_id')
				  ->references('professional_id')->on('professionals')
				  ->onDelete('cascade');
			$table->integer('supplier_id')
				  ->unsigned();
			$table->foreign('supplier_id')
				  ->references('supplier_id')->on('suppliers')
				  ->onDelete('cascade');
			$table->integer('expert_user_id')
				  ->unsigned();
			$table->foreign('expert_user_id')
				  ->references('expert_user_id')->on('expert_users')
				  ->onDelete('cascade');
			$table->rememberToken();
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
		Schema::drop('users');
	}

}

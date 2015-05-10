<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Messages extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('messages', function(Blueprint $table) {
			$table->increments('message_id');
			$table->integer('case_id')
				  ->unsigned();
			$table->foreign('case_id') 
				  ->references('case_id')->on('research_case')
				  ->onDelete('cascade');
			$table->integer('user_id')
				  ->unsigned();
			$table->foreign('user_id') //person  who posted message
				  ->references('user_id')->on('users')
				  ->onDelete('cascade');// rather than cascading try replacing this with a string such as: "[deleted]" 
			$table->text('message');
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
		Schema::drop('messages');
	}

	
}
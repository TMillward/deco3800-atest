<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResearchNotesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('research_notes', function(Blueprint $table)
		{
			$table->increments('research_note_id');
			$table->integer('user_id')
				  ->unsigned();
			$table->foreign('user_id')
				  ->references('user_id')->on('users')
				  ->onDelete('cascade');
			$table->string('title');
			$table->text('research_text');
			$table->string('slug');
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
		Schema::drop('research_notes');
	}

}

<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResearchCaseTable extends Migration {
	
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('research_case', function(Blueprint $table) {
			$table->increments('case_id');
			$table->integer('research_note_id')
				  ->unsigned();
			$table->foreign('research_note_id')
				  ->references('research_note_id')->on('research_notes')
				  ->onDelete('cascade');
			$table->boolean('status'); //false for pending, true for resolved
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
		Schema::drop('research_case');
	}

}
	
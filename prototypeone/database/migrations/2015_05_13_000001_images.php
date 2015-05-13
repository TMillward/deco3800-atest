<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Images extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('images', function(Blueprint $table) {
			$table->string('path'); //path on server
			$table->integer('research_note_id')
				  ->unsigned();
			$table->foreign('research_note_id')
				  ->references('research_note_id')->on('research_notes')
				  ->onDelete('cascade');
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
		Schema::drop('images');
	}
	
}
<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Suppliers extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('suppliers', function(Blueprint $table) {
			$table->increments('supplier_id');
			// Address - may need to decompose more of this for atomicity
			$table->string('street_number')
				  ->nullable(); // Street number (e.g. 43, Lot 2b, etc.)
			$table->string('street_name')
				  ->nullable(); // Street name
			$table->string('suburb')
				  ->nullable(); // Suburb
			$table->string('state')
				  ->nullable(); // State - QLD, NSW, ACT, etc.
			$table->string('post_code')
				  ->nullable(); // Post code
			$table->string('work_phone_number')
				  ->nullable(); // Work phone number
			$table->string('mobile_phone_number')
				  ->nullable(); // Mobile phone number of user -> optional
			$table->text('description')
				  ->nullable(); // Description of this supplier
			// $table->???('equipment_supplied'); // Equipment supplied
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
		Schema::drop('suppliers');
	}

}

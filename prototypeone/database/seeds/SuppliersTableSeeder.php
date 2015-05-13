<?php
use Illuminate\Database\Seeder;
use App\Supplier;

class SuppliersTableSeeder extends Seeder {

	public function run() {
	
		DB::table('suppliers')->delete();
		Supplier::create(array(
			'street_number' 		=> null,
			'street_name'			=> null,
			'suburb'				=> null,
			'state'					=> null,
			'post_code'				=> null,
			'work_phone_number'		=> null,
			'mobile_phone_number'	=> null,
			'description'			=> null,
			'created_at'			=> new DateTime(),
			'updated_at'			=> new DateTime()
		));
		
		Supplier::create(array(
			'street_number' 		=> "9 3/4",
			'street_name'			=> "English Street",
			'suburb'				=> "Sub-urb",
			'state'					=> "QLD",
			'post_code'				=> "4000",
			'work_phone_number'		=> "3333 3333",
			'mobile_phone_number'	=> "0444 4444 444",
			'description'			=> "My company supplies assistive technology",
			'created_at'			=> new DateTime(),
			'updated_at'			=> new DateTime()
		));
	}


}
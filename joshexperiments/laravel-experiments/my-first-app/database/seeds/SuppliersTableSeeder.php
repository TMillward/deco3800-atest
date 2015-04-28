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
			'street_number' 		=> "Platform 9 3/4",
			'street_name'			=> "English Street",
			'suburb'				=> "Sub-urb",
			'state'					=> "TAS",
			'post_code'				=> "1234",
			'work_phone_number'		=> "0000 0000",
			'mobile_phone_number'	=> "0404 0303 231",
			'description'			=> "I am a random supplier. I supply AT",
			'created_at'			=> new DateTime(),
			'updated_at'			=> new DateTime()
		));
	}


}
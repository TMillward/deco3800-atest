<?php
use Illuminate\Database\Seeder;
use App\Professional;

class ProfessionalsTableSeeder extends Seeder {

	public function run() {
	
		DB::table('professionals')->delete();
		Professional::create(array(
			'about' 		=> null,
			'qualifications'=> null,
			'created_at'	=> new DateTime(),
			'updated_at'	=> new DateTime()
		));
		
		Professional::create(array(
			'title'				=> "Ms.",
			'about'				=> "I am an OT",
			'qualifications'	=> "I studied at university xyz and have worked in the industry for 20 years",
			'created_at'		=> new DateTime(),
			'updated_at'		=> new DateTime()
		));
	}


}
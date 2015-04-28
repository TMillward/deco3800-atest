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
			'title'				=> "Mr.",
			'about'				=> "Nothing About Me",
			'qualifications'	=> "I have qualifications",
			'created_at'		=> new DateTime(),
			'updated_at'		=> new DateTime()
		));
	}


}
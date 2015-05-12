<?php
use Illuminate\Database\Seeder;
use App\ExpertUser;

class ExpertUsersTableSeeder extends Seeder {

	public function run() {
	
		DB::table('expert_users')->delete();
		ExpertUser::create(array(
			'qualifications'=> null,
			'created_at'	=> new DateTime(),
			'updated_at'	=> new DateTime()
		));
		
		ExpertUser::create(array(
			'qualifications'	=> "I designed this website. I think it's beautiful",
			'created_at'		=> new DateTime(),
			'updated_at'		=> new DateTime()
		));
	}


}
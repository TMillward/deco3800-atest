<?php
use Illuminate\Database\Seeder;
use App\User;

class UserTableSeeder extends Seeder {

	public function run() {
	
		DB::table('users')->delete();
		User::create(array(
			'username'			=> 'testname',
			'name' 				=> 'Unknown Person',
			'password'			=> Hash::make('chocolateisevil'),
			'usertype'			=> 'Seeker',
			'professional_id'	=> 1,
			'supplier_id'		=> 1,
			'expert_user_id'	=> 1,
			'created_at'		=> new DateTime(),
			'updated_at'		=> new DateTime()
		));
		User::create(array(
			'username' 			=> 'testname2',
			'name'				=> 'Chuck Norris',
			'email'				=> 'a@y.com',
			'password'			=> Hash::make('1234'),
			'usertype'			=> 'Professional',
			'professional_id'	=> 2,
			'supplier_id'		=> 1,
			'expert_user_id'	=> 1,
			'created_at'		=> new DateTime(),
			'updated_at'		=> new DateTime()
		));
		User::create(array(
			'username'			=> 'testname3',
			'name'				=> 'Random Person',
			'password'			=> Hash::make('4321'),
			'usertype'			=> 'Supplier',
			'professional_id'	=> 1,
			'supplier_id'		=> 2,
			'expert_user_id'	=> 1,
			'created_at'		=> new DateTime(),
			'updated_at'		=> new DateTime()
		));
		User::create(array(
			'username'			=> 'testname4',
			'name'				=> 'Number Two',
			'password'			=> Hash::make('1'),
			'usertype'			=> 'Expert User',
			'professional_id' 	=> 1,
			'supplier_id'		=> 1,
			'expert_user_id'	=> 2,
			'created_at'		=> new DateTime(),
			'updated_at'		=> new DateTime()
		));
	}


}
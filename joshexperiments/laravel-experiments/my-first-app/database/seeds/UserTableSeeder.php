<?php
use Illuminate\Database\Seeder;
use App\User;

class UserTableSeeder extends Seeder {

	public function run() {
	
		DB::table('users')->delete();
		User::create(array(
			'username'	=> 'testname',
			'name' 		=> 'Unknown Person',
			'password'	=> Hash::make('chocolateisevil'),
			'created_at'=> new DateTime(),
			'updated_at'=> new DateTime()
		));
		User::create(array(
			'username' 	=> 'testname2',
			'name'		=> 'Chuck Norris',
			'email'		=> 'a@y.com',
			'password'	=> Hash::make('1234'),
			'created_at'=> new DateTime(),
			'updated_at'=> new DateTime()
		));
	}


}
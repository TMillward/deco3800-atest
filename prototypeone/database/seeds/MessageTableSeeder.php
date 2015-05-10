<?php
use Illuminate\Database\Seeder;
use App\Message;

class MessageTableSeeder extends Seeder {
	public function run () {
		DB::table('messages')->delete();
		Message::create(array(
			'case_id' => 1,
			'user_id' => 1,
			'message' => 'Example message.',
			'created_at' => new DateTime(),
			'updated_at' => new DateTime()
		));
		Message::create(array(
			'case_id' => 1,
			'user_id' => 2,
			'message' => 'Example message 2.',
			'created_at' => new DateTime(),
			'updated_at' => new DateTime()
		));
		Message::create(array(
			'case_id' => 1,
			'user_id' => 3,
			'message' => 'Example message 3.',
			'created_at' => new DateTime(),
			'updated_at' => new DateTime()
		));
	}
}
<?php
use Illuminate\Database\Seeder;
use App\Message;

class MessageTableSeeder extends Seeder {
	public function run () {
		DB::table('messages')->delete();
		Message::create(array(
			'case_id' => 1,
			'user_id' => 1,
			'message' => 'Lorem ipsum dolor sit amet, consectetur 
						adipiscing elit. Vivamus tincidunt suscipit sollicitudin. 
						Fusce eget tempus sapien. Maecenas in metus magna. 
						Donec nec augue sit amet ex egestas varius at eget magna.',
			'created_at' => new DateTime(),
			'updated_at' => new DateTime()
		));
		Message::create(array(
			'case_id' => 1,
			'user_id' => 2,
			'message' => 'Sed at ipsum dui. Ut at risus vel odio faucibus maximus a nec nulla.
						Nunc sit amet nisl quis urna ultrices aliquet at at nulla.',
			'created_at' => new DateTime(),
			'updated_at' => new DateTime()
		));
		Message::create(array(
			'case_id' => 1,
			'user_id' => 3,
			'message' => 'Vestibulum ante ipsum primis in faucibus orci luctus 
				et ultrices posuere cubilia Curae; Curabitur a augue id sapien molestie blandit. 
				Vestibulum auctor cursus venenatis.',
			'created_at' => new DateTime(),
			'updated_at' => new DateTime()
		));
	}
}
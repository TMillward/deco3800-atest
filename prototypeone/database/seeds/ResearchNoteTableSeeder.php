<?php
use Illuminate\Database\Seeder;
use App\ResearchNote;

class ResearchNoteTableSeeder extends Seeder {

	public function run() {
	
		DB::table('research_notes')->delete();
		ResearchNote::create(array(
			'user_id'		=> 1,
			'title' 		=> 'Example Research Title',
			'research_text'	=> 'Example Text. I am looking for a device that allows me to perform the tasks x, y and z.',
			'slug' 			=> 'test-slug',
			'created_at'	=> new DateTime(),
			'updated_at'	=> new DateTime()
		));
		ResearchNote::create(array(
			'user_id'		=> 1,
			'title' 		=> 'Example Research Title 2',
			'research_text'	=> 'Example Text. I was doing some resarch of my own when I came across something that I think will benifit me.',
			'slug' 			=> 'test-slug-another',
			'created_at'	=> new DateTime(),
			'updated_at'	=> new DateTime()
		));
		ResearchNote::create(array(
			'user_id'		=> 1,
			'title' 		=> 'Example Research Title',
			'research_text'	=> 'Example Text. My current solution gets in the way when I perform task y',
			'slug' 			=> 'test-slug',
			'created_at'	=> new DateTime(),
			'updated_at'	=> new DateTime()
		));
		ResearchNote::create(array(
			'user_id'		=> 1,
			'title' 		=> 'Example Research Title 2',
			'research_text'	=> 'Example Text. I have condition x and have no idea where to start',
			'slug' 			=> 'test-slug-another',
			'created_at'	=> new DateTime(),
			'updated_at'	=> new DateTime()
		));
	}


}
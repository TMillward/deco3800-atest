<?php
use Illuminate\Database\Seeder;
use App\ResearchNote;

class ResearchNoteTableSeeder extends Seeder {

	public function run() {
	
		DB::table('research_notes')->delete();
		ResearchNote::create(array(
			'user_id'		=> 1,
			'title' 		=> 'Example Research Title',
			'research_text'	=> 'Example Text (not so big)',
			'slug' 			=> 'test-slug',
			'created_at'	=> new DateTime(),
			'updated_at'	=> new DateTime()
		));
		ResearchNote::create(array(
			'user_id'		=> 1,
			'title' 		=> 'Example Research Title 2',
			'research_text'	=> 'Example Text (bla bla bla bla)',
			'slug' 			=> 'test-slug-another',
			'created_at'	=> new DateTime(),
			'updated_at'	=> new DateTime()
		));
		ResearchNote::create(array(
			'user_id'		=> 1,
			'title' 		=> 'Example Research Title',
			'research_text'	=> 'Example Text (not so big)',
			'slug' 			=> 'test-slug',
			'created_at'	=> new DateTime(),
			'updated_at'	=> new DateTime()
		));
		ResearchNote::create(array(
			'user_id'		=> 1,
			'title' 		=> 'Example Research Title 2',
			'research_text'	=> 'Example Text (bla bla bla bla)',
			'slug' 			=> 'test-slug-another',
			'created_at'	=> new DateTime(),
			'updated_at'	=> new DateTime()
		));
	}


}
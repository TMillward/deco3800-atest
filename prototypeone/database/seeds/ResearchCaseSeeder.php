<?php
use Illuminate\Database\Seeder;
use App\ResearchCase;

class ResearchCaseSeeder extends Seeder {
	public function run () {
		DB::table('research_case')-> delete();
		ResearchCase::create(array(
			'research_note_id' => 1,
			'status' => false
		));
		ResearchCase::create(array(
			'research_note_id' => 2,
			'status' => false
		));
	}
}
<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuestionTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('question_types')->insert([
            'name' => 'Multiple choice',
            'slug' => 'multiple_choice',
        ]);
        DB::table('question_types')->insert([
            'name' => 'Missing words',
            'slug' => 'missing_words',
        ]);
        DB::table('question_types')->insert([
            'name' => 'Word order',
            'slug' => 'word_order',
        ]);
        DB::table('question_types')->insert([
            'name' => 'Match',
            'slug' => 'match',
        ]);
    }
}

<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuizTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('quiz_types')->insert([
            'name' => 'Level test',
            'slug' => 'level',
        ]);
        DB::table('quiz_types')->insert([
            'name' => 'Course test',
            'slug' => 'course',
        ]);
    }
}

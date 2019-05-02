<?php

use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $author = \App\Models\Role::create([
            'name' => 'Author',
            'slug' => 'author',
            'permissions' => [
                'create-test' => true,
            ]
        ]);

        $student = \App\Models\Role::create([
            'name' => 'Student',
            'slug' => 'student',
            'permissions' => [
                'get-test' => true,
            ]
        ]);
    }
}

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
        $teacher = \App\Role::create([
            'name' => 'Teacher',
            'slug' => 'teacher',
            'permissions' => [
                'create-test' => true,
                'do-test' => true,
            ]
        ]);
        $student = \App\Role::create([
            'name' => 'Student',
            'slug' => 'student',
            'permissions' => [
                'do-test' => true,
            ]
        ]);
        $moderator = \App\Role::create([
            'name' => 'Moderator',
            'slug' => 'moderator',
            'permissions' => [
                'assign-test' => true,
            ]
        ]);
    }
}

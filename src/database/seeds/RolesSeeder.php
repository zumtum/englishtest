<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'name' => 'Teacher',
            'slug' => 'teacher',
            'permissions' => json_encode([
                'create-test' => true,
                'do-test' => true,
            ])
        ]);
        DB::table('roles')->insert([
            'name' => 'Student',
            'slug' => 'student',
            'permissions' => json_encode([
                'do-test' => true,
            ])
        ]);
        DB::table('roles')->insert([
            'name' => 'Moderator',
            'slug' => 'moderator',
            'permissions' => json_encode([
                'assign-test' => true,
            ])
        ]);
    }
}

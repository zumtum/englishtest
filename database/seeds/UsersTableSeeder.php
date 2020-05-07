<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    private const TEACHER_USER_ID = 1;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'id' => self::TEACHER_USER_ID,
                'name' => 'admin',
                'email' => 'admin@admin.com',
                'password' => Hash::make(env('ADMIN_PASSWORD', 'admin')),
                'role' => RolesSeeder::ROLE_TEACHER['id'],
            ]
        ];

        foreach ($users as $user) {
            DB::table('users')->insert([
                'id' => $user['id'],
                'name' => $user['name'],
                'email' => $user['email'],
                'password' => $user['password'],
            ]);
            DB::table('roles_users')->insert([
                'user_id' => $user['id'],
                'role_id' => $user['role'],
            ]);
        }
    }
}

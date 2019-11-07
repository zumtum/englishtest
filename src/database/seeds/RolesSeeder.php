<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesSeeder extends Seeder
{
    const ROLE_TEACHER = [
        'name' => 'Teacher',
        'slug' => 'teacher'
    ];

    const ROLE_STUDENT = [
        'name' => 'Student',
        'slug' => 'student',
    ];

    const ROLE_MODERATOR = [
        'name' => 'Moderator',
        'slug' => 'moderator',
    ];

    const ROLE_ADMINISTRATOR = [
        'name' => 'Administrator',
        'slug' => 'administrator',
    ];

    const PERMISSIONS = [
        'user' => [
            'view' => 'view-user',
            'create' => 'create-user',
            'update' => 'update-user',
            'delete' => 'delete-user',
            'invite' => 'invite-user',
        ],
        'quiz' => [
            'view' => 'view-quiz',
            'create' => 'create-quiz',
            'update' => 'update-quiz',
            'delete' => 'delete-quiz',
            'do' => 'do-quiz',
        ],
        'question' => [
            'view' => 'view-question',
            'create' => 'create-question',
            'update' => 'update-question',
            'delete' => 'delete-question',
        ],
        'assignment' => [
            'view' => 'view-assignment',
            'create' => 'create-assignment',
            'update' => 'update-assignment',
            'delete' => 'delete-assignment',
            'send' => 'send-assignment',
        ],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'name' => self::ROLE_TEACHER['name'],
            'slug' => self::ROLE_TEACHER['slug'],
            'permissions' => json_encode([
                self::PERMISSIONS['quiz']['do'] => true,
                self::PERMISSIONS['quiz']['view'] => true,
                self::PERMISSIONS['quiz']['create'] => true,
                self::PERMISSIONS['quiz']['update'] => true,
                self::PERMISSIONS['quiz']['delete'] => true,
                self::PERMISSIONS['question']['view'] => true,
                self::PERMISSIONS['question']['create'] => true,
                self::PERMISSIONS['question']['update'] => true,
                self::PERMISSIONS['question']['delete'] => true,
            ])
        ]);
        DB::table('roles')->insert([
            'name' => self::ROLE_STUDENT['name'],
            'slug' => self::ROLE_STUDENT['slug'],
            'permissions' => json_encode([
                self::PERMISSIONS['quiz']['do'] => true,
            ])
        ]);
        DB::table('roles')->insert([
            'name' => self::ROLE_MODERATOR['name'],
            'slug' => self::ROLE_MODERATOR['slug'],
            'permissions' => json_encode([
                self::PERMISSIONS['assignment']['view'] => true,
                self::PERMISSIONS['assignment']['create'] => true,
                self::PERMISSIONS['assignment']['update'] => true,
                self::PERMISSIONS['assignment']['delete'] => true,
                self::PERMISSIONS['assignment']['send'] => true,
                self::PERMISSIONS['user']['invite'] => true,
            ])
        ]);
        DB::table('roles')->insert([
            'name' => self::ROLE_ADMINISTRATOR['name'],
            'slug' => self::ROLE_ADMINISTRATOR['slug'],
            'permissions' => json_encode([
                self::PERMISSIONS['user']['view'] => true,
                self::PERMISSIONS['user']['create'] => true,
                self::PERMISSIONS['user']['update'] => true,
                self::PERMISSIONS['user']['delete'] => true,
                self::PERMISSIONS['user']['invite'] => true,
            ])
        ]);
    }
}

<?php

namespace App\Console\Commands;

use App\Role;
use App\User;
use Illuminate\Console\Command;

class AssignRole extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'assign:role {role} {userEmail}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Assign role to user';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        try {
            $roleSlug = $this->argument('role');
            $role = Role::where('slug', $roleSlug)->first();

            if (!$role) {
                $this->error(sprintf('Invalid role %s', $roleSlug));
            }

            $userEmail = $this->argument('userEmail');
            $user = User::where('email', $userEmail)->first();

            if (!$user) {
                $this->error(sprintf('Invalid user email %s', $userEmail));

                return;
            }

            $user->roles()->attach($role);

            $this->info(sprintf('Role %s is assigned to user %s', $roleSlug, $userEmail));
        } catch (\Exception $exception) {
            $this->error($exception->getMessage());
        }

    }
}

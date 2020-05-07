<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
         'App\Models\Quiz' => 'App\Policies\QuizPolicy',
         'App\Models\Question' => 'App\Policies\QuestionPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('quizzes.control', function (User $user) {
            return $user->hasRoles([\RolesSeeder::ROLE_TEACHER['slug'], \RolesSeeder::ROLE_MODERATOR['slug']]);
        });

        Gate::define('users.control', function (User $user) {
            return $user->hasRoles([\RolesSeeder::ROLE_MODERATOR['slug']]);
        });
    }
}

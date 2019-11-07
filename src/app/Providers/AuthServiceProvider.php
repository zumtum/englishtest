<?php

namespace App\Providers;

use App\User;
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
         'App\Quiz' => 'App\Policies\QuizPolicy',
         'App\Question' => 'App\Policies\QuestionPolicy',
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
            return $user->hasRoles(['teacher', 'moderator']);
        });

        Gate::define('users.control', function (User $user) {
            return $user->hasRoles(['moderator']);
        });
    }
}

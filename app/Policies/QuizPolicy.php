<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Quiz;
use Illuminate\Auth\Access\HandlesAuthorization;

class QuizPolicy
{
    use HandlesAuthorization;

    public function view(User $user): bool
    {
        return $user->hasAccess([\RolesSeeder::PERMISSIONS['quiz']['view']]);
    }

    public function create(User $user): bool
    {
        return $user->hasAccess([\RolesSeeder::PERMISSIONS['quiz']['create']]);
    }

    public function update(User $user, Quiz $quiz): bool
    {
        return $user->id === $quiz->created_by && $user->hasAccess([\RolesSeeder::PERMISSIONS['quiz']['update']]);
    }

    public function delete(User $user, Quiz $quiz): bool
    {
        return $user->id === $quiz->created_by && $user->hasAccess([\RolesSeeder::PERMISSIONS['quiz']['delete']]);
    }
}

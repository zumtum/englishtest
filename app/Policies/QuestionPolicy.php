<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Question;
use Illuminate\Auth\Access\HandlesAuthorization;

class QuestionPolicy
{
    use HandlesAuthorization;

    public function create(User $user): bool
    {
        return $user->hasAccess([\RolesSeeder::PERMISSIONS['question']['create']]);
    }

    public function update(User $user, Question $question): bool
    {
        return $user->id === $question->created_by && $user->hasAccess([\RolesSeeder::PERMISSIONS['question']['update']]);
    }

    public function delete(User $user, Question $question): bool
    {
        return $user->id === $question->created_by && $user->hasAccess([\RolesSeeder::PERMISSIONS['question']['delete']]);
    }
}

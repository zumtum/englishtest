<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AssignmentPolicy
{
    use HandlesAuthorization;

    public function create(User $user): bool
    {
        return $user->hasAccess([\RolesSeeder::PERMISSIONS['assignment']['create']]);
    }

    public function update(User $user): bool
    {
        return $user->hasAccess([\RolesSeeder::PERMISSIONS['assignment']['update']]);
    }

    public function delete(User $user): bool
    {
        return $user->hasAccess([\RolesSeeder::PERMISSIONS['assignment']['delete']]);
    }

    public function send(User $user): bool
    {
        return $user->hasAccess([\RolesSeeder::PERMISSIONS['assignment']['send']]);
    }
}

<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function create(User $user): bool
    {
        return $user->hasAccess([\RolesSeeder::PERMISSIONS['user']['create']]);
    }

    public function update(User $user): bool
    {
        return $user->hasAccess([\RolesSeeder::PERMISSIONS['user']['update']]);
    }

    public function delete(User $user): bool
    {
        return $user->hasAccess([\RolesSeeder::PERMISSIONS['user']['delete']]);
    }

    public function send(User $user): bool
    {
        return $user->hasAccess([\RolesSeeder::PERMISSIONS['user']['invite']]);
    }

}

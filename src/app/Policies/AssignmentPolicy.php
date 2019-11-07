<?php

namespace App\Policies;

use App\User;
use App\Assignment;
use Illuminate\Auth\Access\HandlesAuthorization;

class AssignmentPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the assignment.
     *
     * @param  \App\User  $user
     * @param  \App\Assignment  $assignment
     * @return mixed
     */
    public function view(User $user, Assignment $assignment)
    {
        //
    }

    /**
     * Determine whether the user can create assignments.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasAccess([\RolesSeeder::PERMISSIONS['assignment']['create']]);
    }

    /**
     * Determine whether the user can update the assignment.
     *
     * @param  \App\User  $user
     * @param  \App\Assignment  $assignment
     * @return mixed
     */
    public function update(User $user, Assignment $assignment)
    {
        return $user->hasAccess([\RolesSeeder::PERMISSIONS['assignment']['update']]);
    }

    /**
     * Determine whether the user can delete the assignment.
     *
     * @param  \App\User  $user
     * @param  \App\Assignment  $assignment
     * @return mixed
     */
    public function delete(User $user, Assignment $assignment)
    {
        return $user->hasAccess([\RolesSeeder::PERMISSIONS['assignment']['delete']]);
    }

    /**
     * Determine whether the user can delete the assignment.
     *
     * @param  \App\User  $user
     * @param  \App\Assignment  $assignment
     * @return mixed
     */
    public function send(User $user, Assignment $assignment)
    {
        return $user->hasAccess([\RolesSeeder::PERMISSIONS['assignment']['send']]);
    }

    /**
     * Determine whether the user can restore the assignment.
     *
     * @param  \App\User  $user
     * @param  \App\Assignment  $assignment
     * @return mixed
     */
    public function restore(User $user, Assignment $assignment)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the assignment.
     *
     * @param  \App\User  $user
     * @param  \App\Assignment  $assignment
     * @return mixed
     */
    public function forceDelete(User $user, Assignment $assignment)
    {
        //
    }
}

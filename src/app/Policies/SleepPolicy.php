<?php

namespace App\Policies;

use App\Models\Sleep;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class SleepPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Sleep $sleep): bool
    {
        return $user->id === $sleep->day->baby->home->user_id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Sleep $sleep): bool
    {
        return $user->id === $sleep->day->baby->home->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Sleep $sleep): bool
    {
        return $user->id === $sleep->day->baby->home->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Sleep $sleep): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Sleep $sleep): bool
    {
        return false;
    }
}

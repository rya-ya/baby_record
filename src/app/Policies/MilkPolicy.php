<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Milk;
use Illuminate\Auth\Access\Response;

class MilkPolicy
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
    public function view(User $user, milk $milk): bool
    {
        return $user->id === $milk->day->baby->home->user_id;
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
    public function update(User $user, milk $milk): bool
    {
        return $user->id === $milk->day->baby->home->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, milk $milk): bool
    {
        return $user->id === $milk->day->baby->home->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, milk $milk): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, milk $milk): bool
    {
        return false;
    }
}

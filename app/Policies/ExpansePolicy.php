<?php

namespace App\Policies;

use App\Models\Expanse;
use App\Models\User;

final class ExpansePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return null !== auth()->user();
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Expanse $expanse): bool
    {
        return $expanse->whereHas('lease', fn($builder) => $builder->myLease())->count() > 0;
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
    public function update(User $user, Expanse $expanse): bool
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Expanse $expanse): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Expanse $expanse): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Expanse $expanse): bool
    {
        return false;
    }
}

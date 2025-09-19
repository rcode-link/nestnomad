<?php

namespace App\Policies;

use App\Models\Issues;
use App\Models\User;

final class IssuesPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Issues $issues): bool
    {
        return $issues->property()->iCanAccess()->count() > 0;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return true;

    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Issues $issues): bool
    {
        return $issues->whereHas('property', fn($query) => $query->myProperty())->count() > 0;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Issues $issues): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Issues $issues): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Issues $issues): bool
    {
        return false;
    }
}

<?php

namespace App\Policies;

use App\Models\Lease;
use App\Models\Property;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

final class PropertyPolicy
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
    public function view(User $user, Property $property): bool
    {

        $isLandLord = $property->users->filter(fn(User $obj) => $obj->id === $user->id)->count() > 0;
        $isTenant = $property->lease->filter(fn(Lease $obj) => $obj->user_id === $user->id)->count() > 0;

        return ($isLandLord || $isTenant);
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
    public function update(User $user, Property $property): bool
    {
        return $property->users->filter(fn(User $obj) => $obj->id === $user->id)->count() > 0;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Property $property): bool
    {
        return $property->whereHas('users', fn(Builder $builder) => $builder->where('user_id', $user->id))->count() > 0;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Property $property): bool
    {

        return $property->whereHas('users', fn(Builder $builder) => $builder->where('user_id', $user->id))->count() > 0;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Property $property): bool
    {
        return $property->whereHas('users', fn(Builder $builder) => $builder->where('user_id', $user->id))->count() > 0;
    }
}

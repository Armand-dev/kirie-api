<?php

namespace App\Policies\Landlord;

use App\Models\Landlord\Lease;
use App\Models\Landlord\Property;
use App\Models\User;

class LeasePolicy
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
    public function view(User $user, Lease $lease): bool
    {
        return $user->id == $lease->user_id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        $property = Property::findOrFail(request()->get('property_id'));
        return $property->user_id == $user->id;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Lease $lease): bool
    {
        $property = Property::findOrFail(request()->get('property_id'));
        return $user->id == $lease->user_id && $property->user_id == $user->id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Lease $lease): bool
    {
        return $user->id == $lease->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Lease $lease): bool
    {
        return $user->id == $lease->user_id;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Lease $lease): bool
    {
        return $user->id == $lease->user_id;
    }
}

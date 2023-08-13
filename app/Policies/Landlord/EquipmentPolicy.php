<?php

namespace App\Policies\Landlord;

use App\Models\Landlord\Equipment;
use App\Models\Landlord\Property;
use App\Models\User;

class EquipmentPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasRole('landlord');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Equipment $equipment): bool
    {
        return $user->id == $equipment->user_id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasRole('landlord');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Equipment $equipment): bool
    {
        return $user->id == $equipment->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Equipment $equipment): bool
    {
        return $user->id == $equipment->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Equipment $equipment): bool
    {
        return $user->id == $equipment->user_id;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Equipment $equipment): bool
    {
        return $user->id == $equipment->user_id;
    }
}

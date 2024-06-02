<?php

namespace App\Policies\Landlord;

use App\Models\Landlord\LeaseTemplate;
use App\Models\User;

class LeaseTemplatePolicy
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
    public function view(User $user, LeaseTemplate $leaseTemplate): bool
    {
        return $user->id == $leaseTemplate->user_id || $leaseTemplate->global;
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
    public function update(User $user, LeaseTemplate $leaseTemplate): bool
    {
        return $user->id == $leaseTemplate->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, LeaseTemplate $leaseTemplate): bool
    {
        return $user->id == $leaseTemplate->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, LeaseTemplate $leaseTemplate): bool
    {
        return $user->id == $leaseTemplate->user_id;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, LeaseTemplate $leaseTemplate): bool
    {
        return $user->id == $leaseTemplate->user_id;
    }
}

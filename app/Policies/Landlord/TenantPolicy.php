<?php

namespace App\Policies\Landlord;

use App\Models\Landlord\Tenant;
use App\Models\User;

class TenantPolicy
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
    public function view(User $user, Tenant $tenant): bool
    {
        return in_array($user->id, $tenant->landlords()->pluck('user_id')->toArray()) &&
            $user->hasRole('landlord');
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
    public function update(User $user, Tenant $tenant): bool
    {
        return in_array($user->id, $tenant->landlords()->pluck('user_id')->toArray()) &&
            $user->hasRole('landlord');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Tenant $tenant): bool
    {
        return in_array($user->id, $tenant->landlords()->pluck('user_id')->toArray()) &&
            $user->hasRole('landlord');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Tenant $tenant): bool
    {
        return in_array($user->id, $tenant->landlords()->pluck('user_id')->toArray()) &&
            $user->hasRole('landlord');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Tenant $tenant): bool
    {
        return in_array($user->id, $tenant->landlords()->pluck('user_id')->toArray()) &&
            $user->hasRole('landlord');
    }

    /**
     * @param User $user
     * @param Tenant $tenant
     * @return bool
     */
    public function attachTenant(User $user, Tenant $tenant): bool
    {
        return !in_array($user->id, $tenant->landlords()->pluck('user_id')->toArray()) &&
            $user->hasRole('landlord');
    }
}

<?php

namespace App\Traits\Landlord;

use App\Models\Landlord\Lease;
use App\Models\Landlord\LeaseTemplate;
use App\Models\Landlord\Property;
use App\Models\Landlord\Tenant;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait HasLeases
{
    /**
     * @return HasMany<Property>
     */
    public function properties(): HasMany
    {
        return $this->hasMany(Property::class);
    }

    /**
     * @return HasMany<Lease>
     */
    public function leases(): HasMany
    {
        return $this->hasMany(Lease::class);
    }

    /**
     * @return HasMany<LeaseTemplate>
     */
    public function leaseTemplates(): HasMany
    {
        return $this->hasMany(LeaseTemplate::class);
    }

    /**
     * @return BelongsToMany<Tenant>
     */
    public function tenants(): BelongsToMany
    {
        return $this->belongsToMany(Tenant::class, 'user_tenant', 'user_id', 'tenant_id');
    }

    /**
     * @return HasMany<Transaction>
     */
    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }
}

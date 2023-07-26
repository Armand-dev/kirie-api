<?php

namespace App\Traits\Landlord;

use App\Models\Landlord\Lease;
use App\Models\Landlord\LeaseTemplate;
use App\Models\Landlord\Property;
use App\Models\Landlord\Tenant;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait HasLeases
{
    public function properties(): HasMany
    {
        return $this->hasMany(Property::class);
    }

    public function leases(): HasMany
    {
        return $this->hasMany(Lease::class);
    }

    public function leaseTemplates(): HasMany
    {
        return $this->hasMany(LeaseTemplate::class);
    }

    public function tenants(): BelongsToMany
    {
        return $this->belongsToMany(Tenant::class, 'user_tenant', 'user_id', 'tenant_id');
    }
}

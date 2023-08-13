<?php

namespace App\Traits\Landlord;

use App\Models\Landlord\Document;
use App\Models\Landlord\Equipment;
use App\Models\Landlord\Lease;
use App\Models\Landlord\LeaseTemplate;
use App\Models\Landlord\Property;
use App\Models\Landlord\Tenant;
use App\Models\Landlord\Transaction;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

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

    /**
     * @return HasMany<Document>
     */
    public function documents(): HasMany
    {
        return $this->hasMany(Document::class);
    }

    /**
     * @return HasMany<Equipment>
     */
    public function equipment(): HasMany
    {
        return $this->hasMany(Equipment::class);
    }
}

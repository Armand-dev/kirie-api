<?php

namespace App\Models\Landlord;

use App\Enums\Landlord\LeaseStatus;
use App\Enums\Landlord\PropertyType;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Property extends Model
{
    use HasFactory,
        SoftDeletes;

    protected $guarded = [
        'id'
    ];

    protected $casts = [
        'type' => PropertyType::class
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function leases(): HasMany
    {
        return $this->hasMany(Lease::class);
    }

    public function activeLease(): HasMany
    {
        return $this->hasMany(Lease::class)->where('status', LeaseStatus::Active);
    }
}
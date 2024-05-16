<?php

namespace App\Models\Landlord;

use App\Models\ListingPlatform;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Listing extends Model
{
    protected $guarded = [];

    protected $casts = [
        'images' => 'array',
        'attributes' => 'array',
        'negotiable' => 'bool',
    ];

    public function property(): BelongsTo
    {
        return $this->belongsTo(Property::class);
    }

    public function listingPlatform(): BelongsTo
    {
        return $this->belongsTo(ListingPlatform::class);
    }

    public function scopeOnPlatform(Builder $query, int $platformId): void
    {
        $query->where('listing_platform_id', $platformId);
    }
}

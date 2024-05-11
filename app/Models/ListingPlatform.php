<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ListingPlatform extends Model
{
    use HasFactory;

    const OLX = 1;

    protected $guarded = ['id'];

    /**
     * @return BelongsToMany<User>
     */
    public function user(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'listing_platform_user');
    }
}

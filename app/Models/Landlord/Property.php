<?php

namespace App\Models\Landlord;

use App\Enums\Landlord\LeaseStatus;
use App\Enums\Landlord\PropertyType;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;
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

    /**
     * @return BelongsTo<User, Property>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return HasMany<Lease>
     */
    public function leases(): HasMany
    {
        return $this->hasMany(Lease::class);
    }

    /**
     * @return HasMany<Lease>
     */
    public function activeLease(): HasMany
    {
        return $this->hasMany(Lease::class)->where('status', LeaseStatus::Active);
    }

    /**
     * @return MorphMany<Document>
     */
    public function documents(): MorphMany
    {
        return $this->morphMany(Document::class, 'documentable');
    }

    /**
     * @return HasMany<Transaction>
     */
    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }

    /**
     * @return HasMany<Image>
     */
    public function images(): HasMany
    {
        return $this->hasMany(Image::class)->orderBy('order', 'ASC');
    }

    /**
     * @return HasMany<Image>
     */
    public function thumbnail(): HasMany
    {
        return $this->hasMany(Image::class)->where('order', '=', 1);
    }
}

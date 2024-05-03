<?php

namespace App\Models\Landlord;

use App\Enums\Landlord\LeaseStatus;
use App\Enums\Landlord\SignatureType;
use App\Models\User;
use App\Traits\Landlord\GeneratesPDF;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lease extends Model
{
    use HasFactory,
        SoftDeletes,
        GeneratesPDF;

    protected $guarded = [
        'id'
    ];

    protected $casts = [
        'status' => LeaseStatus::class,
        'signature_type' => SignatureType::class,
        'body' => 'array',
    ];

    /**
     * @return BelongsTo<User, Lease>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return BelongsTo<User, Lease>
     */
    public function tenant(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return BelongsTo<Property, Lease>
     */
    public function property(): BelongsTo
    {
        return $this->belongsTo(Property::class);
    }

    /**
     * @return HasMany<Transaction>
     */
    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }

    /**
     * @param Builder<Lease> $query
     * @return void
     */
    public function scopeActive(Builder $query): void
    {
        $query->where('status', LeaseStatus::Active->value);
    }
}

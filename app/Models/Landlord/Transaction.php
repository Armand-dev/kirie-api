<?php

namespace App\Models\Landlord;

use App\Enums\Landlord\TransactionStatus;
use App\Enums\Landlord\TransactionType;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use HasFactory,
        SoftDeletes;

    protected $guarded = [
        'id'
    ];

    protected $casts = [
        'date' => 'date',
        'type' => TransactionType::class,
        'status' => TransactionStatus::class,
    ];

    /**
     * @return BelongsTo<User, Transaction>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return BelongsTo<Lease, Transaction>
     */
    public function lease(): BelongsTo
    {
        return $this->belongsTo(Lease::class);
    }

    /**
     * @return BelongsTo<Property, Transaction>
     */
    public function property(): BelongsTo
    {
        return $this->belongsTo(Lease::class);
    }
}

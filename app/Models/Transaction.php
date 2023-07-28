<?php

namespace App\Models;

use App\Enums\Landlord\TransactionStatus;
use App\Enums\Landlord\TransactionType;
use App\Models\Landlord\Lease;
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

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function lease(): BelongsTo
    {
        return $this->belongsTo(Lease::class);
    }
}

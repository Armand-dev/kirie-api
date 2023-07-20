<?php

namespace App\Models;

use App\Enums\LeaseStatus;
use App\Enums\SignatureType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\GeneratesPDF;

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
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function property(): BelongsTo
    {
        return $this->belongsTo(Property::class);
    }
}

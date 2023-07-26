<?php

namespace App\Models\Landlord;

use App\Enums\Landlord\LeaseStatus;
use App\Enums\Landlord\SignatureType;
use App\Models\User;
use App\Traits\Landlord\GeneratesPDF;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
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

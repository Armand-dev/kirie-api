<?php

namespace App\Models\Landlord;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Image extends Model
{
    use HasFactory,
        SoftDeletes;

    protected $guarded = ['id'];

    /**
     * @return BelongsTo<Property>
     */
    public function property(): BelongsTo
    {
        return $this->belongsTo(Property::class);
    }
}

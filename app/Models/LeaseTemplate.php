<?php

namespace App\Models;

use App\Enums\LeaseTemplateGlobal;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class LeaseTemplate extends Model
{
    use HasFactory,
        SoftDeletes;

    protected $guarded = [
        'id'
    ];

    protected $casts = [
        'global' => LeaseTemplateGlobal::class
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function scopeGlobal(Builder $query): void
    {
        $query->where('global', true);
    }
}

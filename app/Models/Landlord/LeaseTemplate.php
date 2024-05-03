<?php

namespace App\Models\Landlord;

use App\Enums\Landlord\LeaseTemplateGlobal;
use App\Models\User;
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
        'global' => LeaseTemplateGlobal::class,
        'body' => 'array',
    ];

    /**
     * @return BelongsTo<User, LeaseTemplate>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @param Builder<LeaseTemplate> $query
     * @return void
     */
    public function scopeGlobal(Builder $query): void
    {
        $query->where('global', true);
    }
}

<?php

namespace App\Models\Landlord;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Equipment extends Model
{
    use HasFactory,
        SoftDeletes;

    protected $guarded = ['id'];

    protected $casts = [
        'warranty_expiration' => 'date',
        'installation_time' => 'date',
    ];

    /**
     * @return BelongsTo<Property>
     */
    public function property(): BelongsTo
    {
        return $this->belongsTo(Property::class);
    }

    /**
     * @return BelongsTo<EquipmentCategory>
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(EquipmentCategory::class, 'equipment_category_id');
    }

    /**
     * @return BelongsTo<EquipmentSubcategory>
     */
    public function subcategory(): BelongsTo
    {
        return $this->belongsTo(EquipmentSubcategory::class, 'equipment_subcategory_id');
    }

    /**
     * @return BelongsTo<User>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

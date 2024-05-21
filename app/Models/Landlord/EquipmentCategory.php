<?php

namespace App\Models\Landlord;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class EquipmentCategory extends Model
{
    use HasFactory;

    /**
     * Get the subcategories associated with the equipment.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany The equipment subcategories.
     */
    public function subcategories(): HasMany
    {
        return $this->hasMany(EquipmentSubcategory::class);
    }
}

<?php

namespace Database\Seeders;

use App\Models\Landlord\EquipmentCategory;
use App\Models\Landlord\EquipmentSubcategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EquipmentCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        EquipmentCategory::insert([
            ['id' => 1, 'name' => 'Electric'],
            ['id' => 2, 'name' => 'Conducte apă'],
            ['id' => 3, 'name' => 'Electrocasnice'],
            ['id' => 4, 'name' => 'Exterior'],
        ]);

        EquipmentSubcategory::insert([
            [
                'name' => 'Lustră',
                'equipment_category_id' => 1
            ],
            [
                'name' => 'Țeavă spartă',
                'equipment_category_id' => 2
            ],
            [
                'name' => 'Aer condiționat',
                'equipment_category_id' => 3
            ],
            [
                'name' => 'Televizor',
                'equipment_category_id' => 3
            ],
            [
                'name' => 'Mașină de spălat',
                'equipment_category_id' => 3
            ],
            [
                'name' => 'Mașină de spălat vase',
                'equipment_category_id' => 3
            ],
            [
                'name' => 'Acoperiș',
                'equipment_category_id' => 4
            ],
            [
                'name' => 'Aspersoare gazon',
                'equipment_category_id' => 4
            ],
        ]);
    }
}

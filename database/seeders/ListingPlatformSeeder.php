<?php

namespace Database\Seeders;

use App\Models\ListingPlatform;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class ListingPlatformSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ListingPlatform::updateOrCreate([
            'id' => 1
        ], [
            'name' => 'OlxRO',
            'logo_url' => 'path/to/logo.jpg'
        ]);
    }
}

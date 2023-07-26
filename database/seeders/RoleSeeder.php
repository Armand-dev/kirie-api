<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        Role::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        Role::create(['name' => 'landlord']);
        Role::create(['name' => 'tenant']);
    }
}

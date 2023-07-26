<?php

namespace Database\Seeders;

use App\Models\Landlord\LeaseTemplate;
use Illuminate\Database\Seeder;

class LeaseTemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $body =
            '
                <p>Dear mister :user_name:</p>

                <p>Property name is :property_name:</p>

                <p>Paragraph 3</p>
            ';


        LeaseTemplate::create([
            'name' => 'Contract standard de închiriere',
            'body' => $body,
            'global' => true
        ]);
    }
}

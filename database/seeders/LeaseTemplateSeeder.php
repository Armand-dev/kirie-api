<?php

namespace Database\Seeders;

use App\Models\LeaseTemplate;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
                <p>Paragraph 1</p>

                <p>Paragraph 2</p>

                <p>Paragraph 3</p>
            ';
        LeaseTemplate::create([
            'name' => 'Contract standard de închiriere',
            'body' => $body,
            'global' => true
        ]);
    }
}

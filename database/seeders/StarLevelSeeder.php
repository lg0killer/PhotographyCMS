<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StarLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\StarLevel::factory()->create([
            'name' => '1',
        ]);
        \App\Models\StarLevel::factory()->create([
            'name' => '2',
        ]);
        \App\Models\StarLevel::factory()->create([
            'name' => '3',
        ]);
        \App\Models\StarLevel::factory()->create([
            'name' => '4',
        ]);
        \App\Models\StarLevel::factory()->create([
            'name' => '5',
        ]);
        \App\Models\StarLevel::factory()->create([
            'name' => '5H',
        ]);
    }
}

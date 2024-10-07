<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Placement;
class PlacementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $placements = [
            'Apron',
            'Bags',
            'Cap',
            'Cap Side',
            'Cap Back',
            'Chest (selected)',
            'Gloves',
            'Jacket Back',
            'Patches',
            'Sleeve',
            'Towel',
            'Visor',
            'Others',
        ];

        // Clear existing records to avoid duplicates
        Placement::truncate();

        foreach ($placements as $name) {
            Placement::create([
                'name' => $name,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}

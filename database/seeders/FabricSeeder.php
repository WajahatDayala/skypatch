<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Fabric;
class FabricSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $fabrics = [
            'Blanket',
            'Canis',
            'Canvas',
            'Cotton Woven (selected)',
            'Denim',
            'Felt',
            'Flannel',
            'Fleece',
            'Leather',
            'Nylon',
            'Pique',
            'Polyester',
            'Silk',
            'Single Jersey',
            'Towel',
            'Twill',
            'Others',
        ];

        // Clear existing records to avoid duplicates
        Fabric::truncate();

        foreach ($fabrics as $name) {
            Fabric::create([
                'name' => $name,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}

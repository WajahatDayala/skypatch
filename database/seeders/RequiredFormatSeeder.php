<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\RequiredFormat;
class RequiredFormatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $names = [
            'cdr', 'cnd', 'dsb', 'dst', 'dsz', 'emb', 
            'exp', 'jef', 'ksm', 'ofm', 'pes', 'pdf', 
            'pof', 'tap', 'xxx', 'others'
        ];

        // Clear existing records to avoid duplicates
        RequiredFormat::truncate();

        foreach ($names as $name) {
            RequiredFormat::create([
                'name' => $name,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}

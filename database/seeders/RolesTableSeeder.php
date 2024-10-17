<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $roles = [
            'Admin',
            'Customer Support',
            'Sales',
            'Accounts',
            'Quote Digitizer Leader',
            'Quote Digitizer Worker',
            'Order Digitizer Leader',
            'Order Digitizer Worker',
            'Vector Digitizer Leader',
            'Vector Digitizer Worker',
            
        ];

        foreach ($roles as $role) {
            DB::table('roles')->insert([
                'name' => $role,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;
class RoleSeeder extends Seeder
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

        foreach ($roles as $roleName) {
            Role::create([
                'name' => $roleName, // Use 'role' instead of 'name'
            ]);
        }

    }
}

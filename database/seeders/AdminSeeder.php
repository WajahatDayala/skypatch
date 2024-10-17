<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;
use App\Models\Role; // Import Role model

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        // Sample data with predefined roles
        $admins = [
            [
                'username' => 'admin',
                'name' => 'Admin',
                'email' => 'admin@example.com',
                'password' => Hash::make('password1'), // Secure password
                'role_id' => 1, // Admin role
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username' => 'support',
                'name' => 'Customer Support',
                'email' => 'support@example.com',
                'password' => Hash::make('password1'),
                'role_id' => 2, // Customer Support role
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username' => 'sales',
                'name' => 'Sales',
                'email' => 'sales@example.com',
                'password' => Hash::make('password1'),
                'role_id' => 3, // Sales role
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username' => 'accounts',
                'name' => 'Accounts',
                'email' => 'accounts@example.com',
                'password' => Hash::make('password1'),
                'role_id' => 4, // Accounts role
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username' => 'quote_leader',
                'name' => 'Quote Digitizer Leader',
                'email' => 'quote_leader@example.com',
                'password' => Hash::make('password1'),
                'role_id' => 5, // Quote Digitizer Leader role
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username' => 'quote_worker',
                'name' => 'Quote Digitizer Worker',
                'email' => 'quote_worker@example.com',
                'password' => Hash::make('password1'),
                'role_id' => 6, // Quote Digitizer Worker role
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username' => 'order_leader',
                'name' => 'Order Digitizer Leader',
                'email' => 'order_leader@example.com',
                'password' => Hash::make('password1'),
                'role_id' => 7, // Order Digitizer Leader role
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username' => 'order_worker',
                'name' => 'Order Digitizer Worker',
                'email' => 'order_worker@example.com',
                'password' => Hash::make('password1'),
                'role_id' => 8, // Order Digitizer Worker role
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username' => 'vector_leader',
                'name' => 'Vector Digitizer Leader',
                'email' => 'vector_leader@example.com',
                'password' => Hash::make('password1'),
                'role_id' => 9, // Vector Digitizer Leader role
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username' => 'vector_worker',
                'name' => 'Vector Digitizer Worker',
                'email' => 'vector_worker@example.com',
                'password' => Hash::make('password1'),
                'role_id' => 10, // Vector Digitizer Worker role
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        // Insert data
        foreach ($admins as $admin) {
            Admin::create($admin);
        }
    }
}

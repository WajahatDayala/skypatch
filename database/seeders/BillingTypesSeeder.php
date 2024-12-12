<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BillingTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
         // Insert the billing types with `type` as null
         DB::table('billing_types')->insert([
            ['name' => 'Credit Card', 'type' => null],
            ['name' => 'Credit Card DND', 'type' => null],
            ['name' => 'Paypal', 'type' => null],
            ['name' => 'Paypal DND', 'type' => null],
            ['name' => 'Approval', 'type' => null],
            ['name' => 'Approval DND', 'type' => null],
            ['name' => 'Cheque', 'type' => null],
            ['name' => 'Cheque DND', 'type' => null],
            ['name' => 'NCC', 'type' => null],
            ['name' => 'DNC', 'type' => null],
        ]);
    }
}

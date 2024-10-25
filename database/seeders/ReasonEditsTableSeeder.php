<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReasonEditsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $data = [
            ['emp_id' => 1, 'reason' => 'Reason-1', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['emp_id' => 1, 'reason' => 'Reason-2', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['emp_id' => 1, 'reason' => 'Reason-3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['emp_id' => 1, 'reason' => 'Reason-4', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['emp_id' => 1, 'reason' => 'Reason-5', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            // You can add more entries as needed
        ];

        // Insert the data into the reason_edits table
        DB::table('reason_edits')->insert($data);
    }
}

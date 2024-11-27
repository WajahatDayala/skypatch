<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class ReasonEditsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
       // Data to be inserted or updated
       $data = [
        ['emp_id' => 1, 'reason' => 'Customer changed thread colors', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ['emp_id' => 1, 'reason' => 'Customer modified the design', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ['emp_id' => 1, 'reason' => 'Customer used LC design for cap', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ['emp_id' => 1, 'reason' => 'Design modification / Design modified', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ['emp_id' => 1, 'reason' => 'Digitizing mistake', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ['emp_id' => 1, 'reason' => 'Dst modifications', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ['emp_id' => 1, 'reason' => 'Files/Format requirement', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ['emp_id' => 1, 'reason' => 'Instruction was not followed', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ['emp_id' => 1, 'reason' => 'Minor changes, color change, size, density Etc.', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ['emp_id' => 1, 'reason' => 'New design', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ['emp_id' => 1, 'reason' => 'Other file format issue', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ['emp_id' => 1, 'reason' => 'Others', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
    ];

    // Loop through the data and insert or update
    foreach ($data as $item) {
        DB::table('reason_edits')->updateOrInsert(
            ['emp_id' => $item['emp_id'], 'reason' => $item['reason']], // Unique condition (checking for emp_id and reason)
            [
                'created_at' => $item['created_at'], 
                'updated_at' => $item['updated_at']
            ]
        );
    }
}

}

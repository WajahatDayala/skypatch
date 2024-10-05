<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;
class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Role::create(['roles' => 'superAdmin']);
        Role::create(['roles' => 'admin']);
        Role::create(['roles' => 'followUp']);
        Role::create(['roles' => 'sales']);
        Role::create(['roles' => 'leader']);
        Role::create(['roles' => 'support']);
        Role::create(['roles' => 'accounts']);

        Role::create(['roles' => 'quoteDigitizerLeader']);
        Role::create(['roles' => 'quoteDigitizerWorker']);
       
        Role::create(['roles' => 'orderDigitizerLeader']);
        Role::create(['roles' => 'orderDigitizerWorker']);

        Role::create(['roles' => 'vectorDigitizerLeader']);
        Role::create(['roles' => 'vectorDigitizerWorker']);
    }
}

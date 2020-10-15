<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin[]=\App\Models\Role::create([
            'name'=>'admin',
            'display_name'=>'admin',
            'description'=>'can do anything in the project'
        ]);
        $guest=\App\Models\Role::create([
            'name'=>'guest',
            'display_name'=>'guest',
            'description'=>'can do specific tasks'
        ]);
    }
}

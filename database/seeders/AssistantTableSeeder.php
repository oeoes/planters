<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AssistantTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('assistants')->insert([
            'name' => 'Super Admin',
            'email' => 'auper_admin@planters.com',
            'password' => bcrypt('password'), // password
            'role' => 1
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AgencyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('agencies')->insert([
            'name' => 'agency',
            'email' => 'agency1@planterdev.com',
            'password' => bcrypt('password'), // password
            'company_id' => 1,
        ]);
    }
}

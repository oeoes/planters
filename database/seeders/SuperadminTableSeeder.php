<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SuperadminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('super_admins')->insert([
            'name' => 'Super Admin',
            'email' => 'super_admin@planters-svipb.com',
            'password' => bcrypt('plantersvokasiipb'), // password
        ]);
    }
}

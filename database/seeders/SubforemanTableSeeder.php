<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubforemanTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // $jobs = [
        //     [
        //         'name' => 'Spraying'
        //     ],[
        //         'name' => 'Fertilizer'
        //     ],[
        //         'name' => 'Manual Circle'
        //     ],[
        //         'name' => 'Manual Pruning'
        //     ],[
        //         'name' => 'Manual Gawangan'
        //     ],[
        //         'name' => 'Pest Control'
        //     ],
        // ];

        DB::table('subforemans')->insert([
            'name' => 'subforeman',
            'email' => 'subforeman@planters.com',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'afdelling_id' => 1,
            'jobtype_id' => 1 //sprayig
        ]);
    }
}

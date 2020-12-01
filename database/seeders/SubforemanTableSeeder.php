<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class SubforemanTableSeeder extends Seeder
{
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

        $faker = Faker::create('id_ID');

        for ($i=0; $i < 50; $i++) { 
            if ($i < 5)  $jobtype = 1;
            if ($i <= 5 && $i < 10)  $jobtype = 2;
            if ($i >= 10 && $i < 15)  $jobtype = 3;
            if ($i >= 15 && $i < 20)  $jobtype = 4;
            if ($i >= 20 && $i < 25)  $jobtype = 5;
            if ($i >= 25 && $i < 30)  $jobtype = 6;
            if ($i >= 30 && $i < 40)  $jobtype = 7;
            
            DB::table('subforemans')->insert([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'password' => Hash::make('password'), // password
                'afdelling_id' => 1,
                'jobtype_id' => $jobtype //sprayig
            ]);
        }
    }
}

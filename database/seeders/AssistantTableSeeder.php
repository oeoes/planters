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
        $ran = array(1,2,3,4);
        for ($i=0; $i < 5; $i++) { 
            DB::table('assistants')->insert([
                'name' => 'assistant',
                'email' => 'assistant@planterdev.com',
                'password' => bcrypt('password'), // password
                'afdelling_id' => $ran[array_rand($ran, 1)]
            ]);
        }
    }
}

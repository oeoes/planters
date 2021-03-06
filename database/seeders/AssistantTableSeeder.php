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
            'name' => 'assistant',
            'afdelling_id' => 1,
            'email' => 'assistant@planterdev.com',
            'password' => bcrypt('password'), // password
        ]);
    }
}

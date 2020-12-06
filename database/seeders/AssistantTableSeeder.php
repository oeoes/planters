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
            'email' => 'assistant@planterdev.com',
            'password' => bcrypt('password'), // password
        ]);
    }
}

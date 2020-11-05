<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Foreman1;
use Illuminate\Support\Str;

class Foreman1TableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Foreman1::create([
            'name' => 'foreman1',
            'email' => 'foreman1@email.com',
            'password' => bcrypt('password'), // password
            'remember_token' => Str::random(10),
        ]);
    }
}

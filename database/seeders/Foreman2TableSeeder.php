<?php

namespace Database\Seeders;

use App\Models\Foreman2;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class Foreman2TableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Foreman2::create([
            'name' => 'foreman2',
            'email' => 'foreman2@email.com',
            'password' => bcrypt('password'), // password
            'remember_token' => Str::random(10),
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Assistant;
use Illuminate\Support\Str;

class AssistantTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Assistant::create([
            'name' => 'assistant',
            'email' => 'assistant@planterdev.com',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'role' => 'assistant',
            'super' => 1
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Farm;

class FarmTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['name' => 'Farm1'], 
            ['name' => 'Farm2'], 
            ['name' => 'Farm3']
        ];
        Farm::insert($data);
    }
}

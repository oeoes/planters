<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Afdelling;

class AfdellingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Afdelling::insert([
            ['name' => 'Afdelling1'], 
            ['name' => 'Afdelling2'], 
            ['name' => 'Afdelling3']
        ]);
    }
}

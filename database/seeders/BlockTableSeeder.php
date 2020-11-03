<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Block;

class BlockTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Block::insert([
            ['name' => 'Block1'], 
            ['name' => 'Block2'], 
            ['name' => 'Block3']
        ]);
    }
}

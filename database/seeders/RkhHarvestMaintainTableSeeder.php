<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Maintain\RkhHarvestMaintain;

class RkhHarvestMaintainTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        RkhHarvestMaintain::create([
            'rkh_maintain_id' => '7dd6355f-4827-4a1c-b49f-0600c20e1fc4',
            'fertilizer_type' => 'Caca',
            'fertilizer_amount' => 100,
            'fertilizer_period' => 1
        ]);
    }
}

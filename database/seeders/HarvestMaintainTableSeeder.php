<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Maintain\HarvestMaintain;

class HarvestMaintainTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'rkh_maintain_id' => '7dd6355f-4827-4a1c-b49f-0600c20e1fc4',
                'employee_name'   => 'Dinda',
                'amount_used'     => 10,
                'coverage'        => 12,
            ],[
                'rkh_maintain_id' => '7dd6355f-4827-4a1c-b49f-0600c20e1fc4',
                'employee_name'   => 'Alfin',
                'amount_used'     => 40,
                'coverage'        => 45,
            ]
        ];
        HarvestMaintain::insert($data);
    }
}

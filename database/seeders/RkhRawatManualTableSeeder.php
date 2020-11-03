<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Rkhrawatmanual;

class RkhRawatManualTableSeeder extends Seeder
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
                'rkh_id' => 1,
                'circle' => 180,
                'pruning' => 200,
                'gawangan' => 600
            ],[
                'rkh_id' => 2,
                'circle' => 200,
                'pruning' => 400,
                'gawangan' => 500
            ]
        ];
        Rkhrawatmanual::insert($data);
    }
}

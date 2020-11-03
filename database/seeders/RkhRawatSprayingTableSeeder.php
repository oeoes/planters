<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Rkhrawatspraying;

class RkhRawatSprayingTableSeeder extends Seeder
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
                'jenis_spray' => 'Spraying Brand 1',
                'jml_spray' => 500
            ],[
                'rkh_id' => 2,
                'jenis_spray' => 'Spraying Brand 2',
                'jml_spray' => 300
            ]
        ];
        Rkhrawatspraying::insert($data);
    }
}

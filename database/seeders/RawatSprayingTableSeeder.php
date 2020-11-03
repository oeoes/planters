<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Rawatspraying;

class RawatSprayingTableSeeder extends Seeder
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
                'karyawan' => 'Dora',
                'jml_terpakai' => 120,
                'luas' => 30
            ],[
                'rkh_id' => 1,
                'karyawan' => 'Dora',
                'jml_terpakai' => 5,
                'luas' => 12
            ],[
                'rkh_id' => 2,
                'karyawan' => 'Dora',
                'jml_terpakai' => 80,
                'luas' => 10
            ],[
                'rkh_id' => 2,
                'karyawan' => 'Dora',
                'jml_terpakai' => 65,
                'luas' => 20
            ]
        ];
        Rawatspraying::insert($data);
    }
}

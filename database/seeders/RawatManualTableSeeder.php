<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Rawatmanual;

class RawatManualTableSeeder extends Seeder
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
                'karyawan' => 'karyo',
                'circle' => 30,
                'luas_circle' => 5,
                'pruning' => 10,
                'luas_pruning' => 5,
                'gawangan' => 10,
            ],[
                'rkh_id' => 1,
                'karyawan' => 'Dinda',
                'circle' => 20,
                'luas_circle' => 5,
                'pruning' => 50,
                'luas_pruning' => 5,
                'gawangan' => 100,
            ],[
                'rkh_id' => 2,
                'karyawan' => 'Danang',
                'circle' => 80,
                'luas_circle' => 8,
                'pruning' => 90,
                'luas_pruning' => 20,
                'gawangan' => 200,
            ],[
                'rkh_id' => 2,
                'karyawan' => 'Dodid',
                'circle' => 40,
                'luas_circle' => 15,
                'pruning' => 90,
                'luas_pruning' => 12,
                'gawangan' => 120,
            ]
        ];
        Rawatmanual::insert($data);
    }
}

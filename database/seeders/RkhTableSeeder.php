<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Rkh;

class RkhTableSeeder extends Seeder
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
                'area_id' => 1,
                'md1_id' => 1,
                'md2_id' => 1,
                'pekerjaan' => 1,
                'luas' => 100,
                'populasi' => 200,
                'tanggal_tanam' => date('Y-m-d'),
                'jumlah_karyawan' => 10
            ],[
                'area_id' => 1,
                'md1_id' => 1,
                'md2_id' => 1,
                'pekerjaan' => 1,
                'luas' => 200,
                'populasi' => 200,
                'tanggal_tanam' => date('Y-m-d'),
                'jumlah_karyawan' => 10
            ]
        ];
        Rkh::insert($data);
    }
}

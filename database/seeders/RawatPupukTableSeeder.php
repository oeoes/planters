<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Rawatpupuk;

class RawatPupukTableSeeder extends Seeder
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
                'karyawan' => 'Diana',
                'jml_terpakai' => 10,
                'luas' => 20
            ],[
                'rkh_id' => 1,
                'karyawan' => 'Dora',
                'jml_terpakai' => 30,
                'luas' => 16
            ],[
                'rkh_id' => 1,
                'karyawan' => 'Alfin',
                'jml_terpakai' => 20,
                'luas' => 30
            ],[
                'rkh_id' => 2,
                'karyawan' => 'Diana',
                'jml_terpakai' => 40,
                'luas' => 10
            ],[
                'rkh_id' => 2,
                'karyawan' => 'Dora',
                'jml_terpakai' => 5,
                'luas' => 22
            ],[
                'rkh_id' => 2,
                'karyawan' => 'Alfin',
                'jml_terpakai' => 15,
                'luas' => 12
            ]
        ];
        Rawatpupuk::insert($data);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Rkhrawatpupuk;

class RkhRawatPupukTableSeeder extends Seeder
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
                'jenis_pupuk' => 'Kompos',
                'jml_pupuk' => 100,
                'periode_pupuk' => 1,
            ],[
                'rkh_id' => 2,
                'jenis_pupuk' => 'Pupuk Fucking',
                'jml_pupuk' => 300,
                'periode_pupuk' => 2,
            ]
        ];
        Rkhrawatpupuk::insert($data);
    }
}

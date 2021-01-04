<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompanyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $companies = [
            [
            'company_code' => 'COM1',
            'company_name' => 'PT Sawit Berjangka'
            ], [
            'company_code' => 'COM2',
            'company_name' => 'PT Triberas Futures Fruit'
            ],            
        ];
        DB::table('companies')->insert($companies);
    }
}

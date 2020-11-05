<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RkhMaintainRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    // List
    /* 
        "md2" => "1"
        "farm" => "3"
        "afdelling" => "1"
        "luas" => "12"
        "populasi" => "12"
        "tahun_tanam" => "2020-11-05"
        "jumlah_karyawan" => "12"
        "circle" => "1"
        "prunning" => "1"
        "gawangan" => "1"
        "jenis_pupuk" => "12"
        "qty_pupuk" => "12"
        "periode_rawat_pupuk" => array:1 [▶]
        "jenis_spraying" => "2"
        "qty" => "12"
    */

    public function rules()
    {
        return [
            'farm'            => 'required',
            'afdelling'       => 'required',
            'luas'            => 'required',
            'populasi'        => 'required|min:1|numeric',
            'tahun_tanam'     => 'required|date',
            'jumlah_karyawan' => 'required|numeric|min:1',
            'circle'          => 'required|numeric|min:1',
            'prunning'        => 'required|numeric|min:1',
            'gawangan'        => 'required|numeric|min:1',
            'jenis_pupuk'     => 'required',
            'qty_pupuk'       => 'required|numeric|min:1',
            'periode_rawat_pupuk' => 'required|min:1|max:2',
            'jenis_spraying'  => 'required',
            'qty_spraying'    => 'required|numeric|min:1'
        ];  
    }

    public function attributes()
    {
        return [

        ];
    }

    public function messages()
    {
        return [
            'farm'            => 'Kebun',
            'afdelling'       => 'Afdelling',
            'luas'            => 'Luas',
            'populasi'        => 'Populasi',
            'tahun_tanam'     => 'Tahun tanam',
            'jumlah_karyawan' => 'Jumlah karyawan',
            'circle'          => 'Circle',
            'prunning'        => 'Prunning',
            'gawangan'        => 'Gawangan',
            'jenis_pupuk'     => 'Jenis pupuk',
            'qty_pupuk'       => 'Jumlah pupuk',
            'periode_rawat_pupuk' => 'Periode',
            'jenis_spraying'  => 'Jenis spraying',
            'qty_spraying'    => 'Jumlah spraying'
        ];
    }
}

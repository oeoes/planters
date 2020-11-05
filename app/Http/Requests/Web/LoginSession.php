<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginSession extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'email' => ['required', 'email'],
            'password' => ['required']
        ];
    }

    public function messages()
    {
        return [
            'email.required' => ':attribute harus diisi',
            'email.email' => ':attribute tidak valid',
            'email.min' => ':attribute minimal :min',
            'password.required' => ':attribute harus diisi',
        ];
    }

    public function attributes()
    {
        return [
            'email' => 'Alamat email',
            'password' => 'Kata sandi'
        ];
    }
}

<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

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

    // For return API
    protected function failedValidation(Validator $validator){
        $status = 'error';
        $message = $validator->errors();
        $data = null;
        throw new HttpResponseException(jsonformat($status, $message, $data)); 
    }
}

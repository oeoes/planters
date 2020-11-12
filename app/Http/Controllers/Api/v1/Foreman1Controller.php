<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Exception;
use App\Models\Foreman1;
use App\Models\Foreman2;
use Validator;
use Illuminate\Support\Facades\Hash;

class Foreman1Controller extends Controller
{
    public function update_name_foreman(Request $request) {
        $request->validate([ 'name' => 'required' ]);
        Foreman1::find($request->id)->update([ 'name' => $request->name]);
        return res(true, 200, 'Name updated successfully', Foreman1::find($request->id));
    }

    public function update_email_foreman(Request $request) {
        $request->validate([ 'email' => 'required|unique:foremans1|email' ]);
        Foreman1::find($request->id)->update([ 'email' => $request->email]);
        return res(true, 200, 'Email updated successfully', Foreman1::find($request->id));
    }

    public function update_password_foreman(Request $request) {
        $request->validate([
            // now_password is password same as in table
            'now_password'          => 'required|min:8',
            'password'              => 'required|min:8|confirmed|different:now_password',
            'password_confirmation' => 'required|min:8',
        ]);
        $now_password = $request->now_password;
        if(Hash::check($now_password, Auth::guard('foreman1')->user()->password)){
            Foreman1::find($request->id)->update([ 
                'password' => Hash::make($request->password)
            ]);
            return res(true, 200, 'Password updated successfully', Foreman1::find($request->id));
            
        } else {
            return res(true, 403, 'Unable to change password');
        }
    }
}

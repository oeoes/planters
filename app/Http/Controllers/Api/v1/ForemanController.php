<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Exception;
use App\Models\Foreman1;
use App\Models\Foreman2;
use Validator;

class ForemanController extends Controller
{
    public function update_name_foreman1(Request $request) {
        if (Auth::guard('foreman1')->check()) {
            $request->validate([
                'name' => 'required',
            ]);

            Foreman1::find($request->id)->update([ 'name' => $request->name]);
            $data = [
                'status' => 'success',
                'data' => Foreman1::find($request->id)
            ];
            return response()->json($data, 200);
        }
    }

    public function update_email_foreman1(Request $request) {
        if (Auth::guard('foreman1')->check()) {
            $request->validate([
                'email' => 'required|unique:foremans1,email'
            ]);

            Foreman1::find($request->id)->update([ 'email' => $request->email]);
            $data = [
                'status' => 'success',
                'data' => Foreman1::find($request->id)
            ];
            return response()->json($data, 200);
        }
    }
}

<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Exception;

class ForemanController extends Controller
{
    public function update_foreman1(Request $request) {
        if (Auth::guard('foreman1')->check()) {
            
            return response()->json(['msg' => 'success'], 200);
        }
    }
}

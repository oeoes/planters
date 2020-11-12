<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Foreman1
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (! Auth::guard('foreman1')->check()) {
            $data = [
                'status' => 'error',
                'message' => 'Wrong foreman'
            ];
            return response()->json($data, 400);
        }
        return $next($request);
    }
}

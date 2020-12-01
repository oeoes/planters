<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Subforeman
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
        config()->set( 'auth.defaults.guard', 'subforeman' );
        if (! Auth::guard('subforeman')->check()) {
            return res(false, 400, 'Wrong foreman');
        }
        return $next($request);
    }
}

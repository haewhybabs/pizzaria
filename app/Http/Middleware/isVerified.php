<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class isVerified
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check())
        {
            if(!Auth::user()->email_verified_at)
            {
                if($request->ajax()) {
                    return response()->json(['error'=>'Invalid access'], 401);
                }
                return redirect('/verifyUser');
            }
        }
        return $next($request);
    }
}
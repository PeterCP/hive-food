<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
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

        if( $request->user() != null){
            if ($request->user()->hasRole('admin')) {
                return redirect('/admin');
            } else if ($request->user()->hasRole('client') ) {
                return redirect('/comensal');
            }
        }

        if (Auth::guard($guard)->check()) {
            return redirect('/login');
        }

        return $next($request);
    }
}

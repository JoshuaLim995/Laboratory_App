<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Session;

class Superadmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Auth::user()->isdlmsa()){
            return $next($request);
        }
        Session::flash('warning', 'Access Denied. You do not have the superadmin access');
        return back();
    }
}

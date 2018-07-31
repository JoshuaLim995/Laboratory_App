<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Session;

class Staff
{
    public function handle($request, Closure $next)
    {
        if(Auth::user()->isStaff()){
            return $next($request);
        }
        Session::flash('warning', 'Access Denied. You do not have this access');
        return back();
    }
}

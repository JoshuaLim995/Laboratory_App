<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Session;

class Admin
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
        // if(Bouncer::is(Auth::user())->a('admin')){
        if(Auth::user()->isAdmin()){
            return $next($request);
        }
        Session::flash('warning', 'Access Denied. You do not have the admin access');
        return back();
    }
}

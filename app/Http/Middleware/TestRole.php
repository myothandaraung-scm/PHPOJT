<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Closure;

class TestRole
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
        log::info("testrole");
        log::info(Auth::user());
        if (Auth::user() &&  Auth::user()->type == '0') {
            return $next($request);
       }

       return redirect()->route('user.index')->with('roleError','You have not admin access');
    //    redirect()->route('user.login')
    //     //return $next($request);
    }
}

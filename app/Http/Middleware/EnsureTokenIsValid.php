<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Closure;

class EnsureTokenIsValid
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
        log::info(Auth::user());
        if ($request->has('_token')) {
            return $next($request);    
        }
        else{
            if(Auth::user()){
                return $next($request);
            }
            return redirect()->route('user.login');           
        }        
    }
}

<?php

namespace App\Http\Middleware;

use Closure;

class UserMiddleware
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
        if(isset($request->user()->user_type)&& $request->user()->user_type=='user'){
            return $next($request);
        }
        else{
            return response()->view('Login::login');
           
        }
    }
}

<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        //admin role = 1
        //user  role = 0

        if(Auth::check()){
            if(Auth::user()->role == '1'){
                return $next($request);
            }else{
                return redirect('/')->with('message','Please Login As Admin');
            }
        }else{
            return redirect('/login')->with('message','Please Login First');
        }
        
        return $next($request);
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        //if we go to login page or register page
        if(!empty(Auth::user()))
        {
            //dd(url()->current());//သွားချင်တဲ့ location
            //dd(route("category#list"));//တိုက်ချင်တဲ့ လမ်းကြောင်း
            if(url()->current() == route("auth#loginPage") || url()->current() == route("auth#registerPage"))
            {
                return back();
            }

            if(Auth::user()->role=="user")
            {
                return back();
            }
            return $next($request);
        }

        return $next($request);
        
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class adminAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(session()->has('Admin_login'))
         {
            
         }else
         {
             $request->session()->flash('error','Access Denied');
             return redirect(route('admin'));
         }
        return $next($request);
    }
}

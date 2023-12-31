<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class is_status
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        if (auth()->guard('web')->user()->status == 1) {
            return $next($request);
       }
       $value = session('key', 'default');
       return redirect()->route('logout')->with('error','You have not admin access');
      
    }
}

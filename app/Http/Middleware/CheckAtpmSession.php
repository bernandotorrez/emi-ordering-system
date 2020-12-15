<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckAtpmSession
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
        if($request->session()->get('user')['status_atpm'] != 'atpm') {
            return redirect('/home');
        }

        return $next($request);
    }
}

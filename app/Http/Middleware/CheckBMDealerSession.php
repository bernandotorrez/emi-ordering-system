<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckBMDealerSession
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
        if($request->session()->get('user')['id_dealer_level'] != 'BM') {
            return redirect('/home');
        }

        return $next($request);
    }
}

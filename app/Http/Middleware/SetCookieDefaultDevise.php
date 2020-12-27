<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Cookie;

class SetCookieDefaultDevise
{
    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!Cookie::has('devise')){

            $devise = cookie('devise', 'USD');

            return redirect('')->withCookie($devise);
        }
        return $next($request);
    }
}

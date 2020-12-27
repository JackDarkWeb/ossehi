<?php

namespace App\Http\Middleware;

use App\Helpers\Auth;
use Closure;
use Illuminate\Http\RedirectResponse;


class RedirectIfAuthenticated
{
    /**
     * @param $request
     * @param Closure $next
     * @param null $guard
     * @return RedirectResponse|mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::is()) {
            return back();
        }
        return $next($request);
    }
}

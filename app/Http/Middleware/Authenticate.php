<?php

namespace App\Http\Middleware;

use App\Helpers\Auth;
use Closure;
use Illuminate\Http\Request;

class Authenticate
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
        if(!Auth::is()){
            return redirect(route_name('home'))->with('notify_generals', __('You must log in'));
        }
        return $next($request);
    }
}

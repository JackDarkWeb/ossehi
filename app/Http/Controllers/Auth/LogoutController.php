<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Session;

class LogoutController extends Controller
{
    /**
     * @return Application|RedirectResponse|Redirector
     */
    protected function loggedOut()
    {
        if(Session::has('auth')){

            Session::forget('auth');

            return redirect(route_name('home'));
        }
        return back();
    }
}

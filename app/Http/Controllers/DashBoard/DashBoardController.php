<?php

namespace App\Http\Controllers\DashBoard;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

class DashBoardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @return Application|Factory|View
     */

    function showDashBoard(){

        return view('dashboard.dashboard');
    }

    /**
     * @return Application|Factory|View
     */
    function showInformationAccount(){

        return view('dashboard.my-account');
    }
}

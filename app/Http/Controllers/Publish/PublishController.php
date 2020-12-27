<?php

namespace App\Http\Controllers\Publish;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;

use Illuminate\Http\Response;

use Illuminate\View\View;

class PublishController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|Response|View
     */
    public function showMenus()
    {
        return view('publish.menus');
    }



    /**
     * @return Application|Factory|View
     */
    public function createAnnounce(){

        return view('publish.announce');
    }





}

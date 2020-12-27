<?php

namespace App\Http\Controllers\Various;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\VariousRepositoryContract;

class VariousController extends Controller
{
    protected VariousRepositoryContract $variousRepository;

    public function __construct(VariousRepositoryContract $variousRepository)
    {
        $this->variousRepository = $variousRepository;
    }

    function AllVariouses(){

        $variouses = $this->variousRepository->getAll();

        return view('various.index',[
            'variouses' => $variouses
        ]);
    }

    function singleVarious($lang, $slug){

        $various = $this->variousRepository->findBySlug($slug);

        if (!$various){
            return back();
        }

        $comments = $this->variousRepository->getCommentsByVarious($various);

        return view('various.single',[
            'various' => $various,
            'comments' => $comments
        ]);
    }

    function typeVarious($lang, $name){

        $variouses = $this->variousRepository->getAllByType($name);

        if (!$variouses){
            return back();
        }

        return view('various.type',[
            'variouses' => $variouses
        ]);
    }
}

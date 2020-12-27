<?php

namespace App\Http\Controllers;




use App\Repositories\Contracts\ProductRepositoryContract;
use App\Repositories\Contracts\StoreRepositoryContract;

class HomeController extends Controller
{
    protected StoreRepositoryContract $storeRepository;
    protected ProductRepositoryContract $productRepository;

    public function __construct(StoreRepositoryContract $storeRepository, ProductRepositoryContract $productRepository)
    {
        $this->storeRepository = $storeRepository;
        $this->productRepository = $productRepository;
    }

    function home(){

        $stores = $this->storeRepository->getByParts(4);

        return view('welcome',[
            'stores' => $stores
        ]);
    }
}

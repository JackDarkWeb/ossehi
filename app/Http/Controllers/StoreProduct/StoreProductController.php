<?php

namespace App\Http\Controllers\StoreProduct;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\StoreProductRepositoryContract;
use App\Repositories\Contracts\StoreRepositoryContract;


class StoreProductController extends Controller
{
    protected StoreRepositoryContract $storeRepository;
    protected StoreProductRepositoryContract $storeProductRepository;

    public function __construct(StoreRepositoryContract $storeRepository, StoreProductRepositoryContract $storeProductRepository)
    {
        $this->storeRepository = $storeRepository;
        $this->storeProductRepository = $storeProductRepository;
    }




    function allProductsStore($lang, $slug){

        $store = $this->storeRepository->findBySlug($slug);

        if (!$store){
            return back();
        }

        $products = $this->storeProductRepository->getStoreProductsByStore($store);

        return view('storeProduct.products',[
            'store' => $store,
            'products' => $products
        ]);
    }


    function ShowSingleProductStore($lang, $slug){

        $product = $this->storeProductRepository->findBySlug($slug);

        if (!$product){
            return back();
        }

        $store = $this->storeRepository->findByStoreProduct($product);

        $comments = $this->storeProductRepository->getCommentsByStoreProduct($product);


        return view('storeProduct.single',[
            'store' => $store,
            'product' => $product,
            'comments' => $comments
        ]);
    }


    function quickViewStore($lang, $slug){

        $product = $this->storeProductRepository->findBySlug($slug);

        if (!$product){
            return back();
        }

        return view('storeProduct.store-product-quick-view',[
            'product' => $product
        ]);
    }
}

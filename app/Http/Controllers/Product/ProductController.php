<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\CategoryRepositoryContract;
use App\Repositories\Contracts\ProductRepositoryContract;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;


class ProductController extends Controller
{
    protected ProductRepositoryContract $productRepository;
    protected CategoryRepositoryContract $categoryRepository;

    public function __construct(CategoryRepositoryContract $categoryRepository, ProductRepositoryContract $productRepository)
    {
        $this->categoryRepository = $categoryRepository;
        $this->productRepository  = $productRepository;
    }



    /**
     * @param $lang
     * @param $slug
     * @return Application|Factory|RedirectResponse|View
     */
    public function singleProduct($lang, $slug){

        $product = $this->productRepository->findBySlug($slug);

        if (!$product){

            return back();
        }

        $category = $this->categoryRepository->findById($product);

        $comments = $this->productRepository->getCommentsByProduct($product);

        return view('product.product',[
            'product' => $product,
            'category' => $category,
            'comments' => $comments
        ]);

    }

    public function productsSubCategory($lang, $category_name, $sub_category_name){

        $category = $this->categoryRepository->findByName($category_name);

        if(!$category){
            return back();
        }

        $products = $this->productRepository->getProductsBySubCategory($category, $sub_category_name);

        return view('product.products-by-subcategory',[
            'products' => $products
        ]);

    }


    function quickView($lang, $slug){

        $product = $this->productRepository->findBySlug($slug);

        if (!$product){
            return back();
        }

        return view('product.product-quick-view',[
            'product' => $product
        ]);
    }
}

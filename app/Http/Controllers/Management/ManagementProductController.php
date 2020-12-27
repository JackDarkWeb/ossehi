<?php

namespace App\Http\Controllers\Management;

use App\Helpers\Auth;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\GalleryRepositoryContract;
use App\Repositories\Contracts\ProductRepositoryContract;
use App\Services\Contracts\RedisServiceContract;
use App\Services\ProductService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ManagementProductController extends Controller
{
    protected ProductRepositoryContract $productRepository;
    protected ProductService $productService;
    protected GalleryRepositoryContract $galleryRepository;
    protected RedisServiceContract $redisService;

    public function __construct(ProductRepositoryContract $productRepository, ProductService $productService, GalleryRepositoryContract $galleryRepository, RedisServiceContract $redisService)
    {
        $this->middleware('auth');

        $this->productRepository  = $productRepository;
        $this->productService = $productService;
        $this->galleryRepository = $galleryRepository;
        $this->redisService = $redisService;

    }

    /**
     * @return Application|Factory|RedirectResponse|View
     */
    public function formProduct(){

        if (request()->ajax()){

            return view('management.product.create-product');
        }
        return back();
    }

    /**
     * @param Request $request
     * @return JsonResponse|RedirectResponse
     */
    public function requestProduct(Request $request){

        if ($request->ajax()){

            $errors = $this->productService->productFormRequest($request);

            if (!is_null($errors)){

                return response()->json(['success' => false, 'messages' => $errors], 400);
            }

            $product = $this->productRepository->create($request);


            $this->productRepository->createGalleries($product);

            $this->redisService->incrementCounterOperationUser(Auth::id(), 'product_counter');

            return response()->json(['success' => true, 'slug' => $product->slug], 201);

        }
        return back();
    }


    /**
     * @return mixed
     */
    public function products(){

        $products = $this->productRepository->getAllByUser();

        return view('management.product.products',[
            'products' => $products
        ]);
    }

    /**
     * @param $lang
     * @param $product_id
     * @param $slug
     * @param $price
     * @param $devise
     * @return Application|Factory|RedirectResponse|View
     */
    public function formDiscount($lang, $product_id, $slug, $price, $devise){

        if (request()->ajax()){

            return view('management.product.discount-form',[
                'product_id' => $product_id,
                'slug' => $slug,
                'price' => $price,
                'devise' => $devise
            ]);
        }
        return back();
    }

    /**
     * @param Request $request
     * @param $lang
     * @param $product_id
     * @param $slug
     * @param $price
     * @param $devise
     * @return JsonResponse|RedirectResponse
     */
    public function addDiscount(Request $request, $lang, $product_id, $slug, $price, $devise){

        if ($request->ajax()){

            $product = $this->productRepository->findProductByUser($slug);

            if ($product){

                $this->productRepository->updateDiscount($product, $request);

                return response()->json(['success' => true, 'old_price' => $product->price_product_with_devise, 'discount_price' => $product->price_discount_with_devise, 'routeCancelDiscountName' => route('cancel.discount', ['lang' => app()->getLocale(), 'product_id' => $product_id, 'slug' => $slug])], 200);
            }
            return response()->json(['success' => false, 'error' => __('Product not found')], 404);
        }
        return back();
    }

    /**
     * @param $lang
     * @param $product_id
     * @param $slug
     * @return JsonResponse|RedirectResponse
     */
    public function cancelDiscount($lang, $product_id, $slug){

       if (request()->ajax()){

           $product = $this->productRepository->findProductByUser($slug);

           if ($product){

               $this->productRepository->cancelDiscount($product);

               return response()->json(['success' => true], 200);
           }
           return response()->json(['success' => false, 'error' => __('Product not found')], 404);
       }
        return back();
    }

    /**
     * @param $lang
     * @param $product_id
     * @param $slug
     * @return Application|Factory|RedirectResponse|View
     */
    public function editProduct($lang, $product_id, $slug){

       if (request()->ajax()){

           $product = $this->productRepository->findProductByUser($slug);

           return view('management.product.edit-product',[
               'product' => $product
           ]);
       }
       return back();
    }

    /**
     * @param Request $request
     * @param $lang
     * @param $product_id
     * @param $slug
     * @return JsonResponse|RedirectResponse
     */
    public function updateProduct(Request $request, $lang, $product_id, $slug){

        if ($request->ajax()){

            $errors = $this->productService->productUpdateFormRequest($request);

            if (!is_null($errors)){

                return response()->json(['success' => false, 'messages' => $errors], 400);
            }

            $product = $this->productRepository->findProductByUser($slug);

            if ($product){

                $this->productRepository->update($product, $request);

                return response()->json(['success' => true], 200);
            }
            return response()->json(['success' => false, 'error' => __('Product not found')], 404);
        }
        return back();
    }

    /**
     * @param $lang
     * @param $product_id
     * @param $slug
     * @return JsonResponse|RedirectResponse
     */
    public function destroyProduct($lang, $product_id, $slug){

        if (request()->ajax()){

            $product = $this->productRepository->findProductByUser($slug);

            if ($product){

                $this->productRepository->destroy($product);

                $this->galleryRepository->destroyByProduct($product);

                $this->redisService->decrementCounterOperationUser(Auth::id(), 'product_counter');

                return response()->json(['success' => true], 200);
            }
            return response()->json(['success' => false, 'error' => __('Product not found')], 404);
        }
        return back();

    }




}

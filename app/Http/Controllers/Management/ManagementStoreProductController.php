<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\GalleryRepositoryContract;
use App\Repositories\Contracts\StoreProductRepositoryContract;
use App\Repositories\Contracts\StoreRepositoryContract;
use App\Services\StoreProductService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ManagementStoreProductController extends Controller
{
    protected StoreProductRepositoryContract $storeProductRepository;
    protected StoreProductService $storeProductService;
    protected StoreRepositoryContract $storeRepository;
    protected GalleryRepositoryContract $galleryRepository;

    public function __construct(StoreProductRepositoryContract $storeProductRepository, StoreProductService  $storeProductService, StoreRepositoryContract $storeRepository, GalleryRepositoryContract $galleryRepository)
    {
        $this->middleware('auth');

        $this->storeProductRepository = $storeProductRepository;
        $this->storeProductService = $storeProductService;
        $this->storeRepository = $storeRepository;
        $this->galleryRepository = $galleryRepository;
    }

    public function formProduct($lang, $slug){

        if (request()->ajax()){

            return view('management.store-product.create-product',[
                'slug_store' => $slug
            ]);
        }
        return back();
    }

    public function createProduct(Request $request, $lang, $slug_store){

        if ($request->ajax()){

            $errors = $this->storeProductService->storeProductFormRequest($request);

            if (!is_null($errors)){

                return response()->json(['success' => false, 'messages' => $errors], 400);
            }

            $store = $this->storeRepository->findStoreByUSer($slug_store);

            if ($store){

                $product = $this->storeProductRepository->create($store, $request);

                $this->storeProductRepository->createGalleries($product);

                return response()->json(['success' => true, 'slug' => $product->slug], 201);
            }

            return response()->json(['success' => false, 'error' => 'Store not found'], 404);

        }
        return back();
    }



    public function formDiscount($lang, $product_id, $slug, $price, $devise){

        if (request()->ajax()){

            return view('management.store-product.discount-form',[
                'product_id' => $product_id,
                'slug' => $slug,
                'price' => $price,
                'devise' => $devise
            ]);
        }
        return back();
    }

    public function addDiscount(Request $request, $lang, $product_id, $slug, $price, $devise){

        if ($request->ajax()){

            $product = $this->storeProductRepository->findBySlug($slug);

            if ($product){

                $store = $this->storeRepository->findByStoreProductAndUser($product);

                if ($store){

                    $this->storeProductRepository->updateDiscount($product, $request);

                    return response()->json(['success' => true, 'old_price' => $product->price_store_product_with_devise, 'discount_price' => $product->price_discount_with_devise, 'routeCancelDiscountName' => route('cancel.discount.store_product', ['lang' => app()->getLocale(), 'product_id' => $product_id, 'slug' => $slug])], 200);
                }

                return response()->json(['success' => false, 'error' => __('Product not found')], 404);
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

            $product = $this->storeProductRepository->findBySlug($slug);

            if ($product){

                $store = $this->storeRepository->findByStoreProductAndUser($product);

                if ($store){

                    $this->storeProductRepository->cancelDiscount($product);

                    return response()->json(['success' => true], 200);
                }
                return response()->json(['success' => false, 'error' => __('Product not found')], 404);
            }
            return response()->json(['success' => false, 'error' => __('Product not found')], 404);
        }
        return back();
    }

    /**
     * @param $lang
     * @param $product_id
     * @param $slug
     * @return Application|Factory|JsonResponse|RedirectResponse|View
     */
    public function editProduct($lang, $product_id, $slug){

        if (request()->ajax()){

            $product = $this->storeProductRepository->findBySlug($slug);

            if ($product){

                $store = $this->storeRepository->findByStoreProductAndUser($product);

                if ($store){

                    return view('management.store-product.edit-product',[
                        'product' => $product
                    ]);
                }
                return response()->json(['success' => false, 'error' => __('Product not found')], 404);
            }
            return response()->json(['success' => false, 'error' => __('Product not found')], 404);

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

            $errors = $this->storeProductService->storeProductUpdateFormRequest($request);

            if (!is_null($errors)){

                return response()->json(['success' => false, 'messages' => $errors], 400);
            }

            $product = $this->storeProductRepository->findBySlug($slug);

            if ($product){

                $store = $this->storeRepository->findByStoreProductAndUser($product);

                if ($store){

                    $this->storeProductRepository->update($product, $request);

                    return response()->json(['success' => true], 200);
                }
                return response()->json(['success' => false, 'error' => __('Product not found')], 404);
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

            $product = $this->storeProductRepository->findBySlug($slug);

            if ($product){

                $store = $this->storeRepository->findByStoreProductAndUser($product);

                if ($store){

                    $this->storeProductRepository->destroy($product);

                    $this->galleryRepository->destroyByProduct($product);

                    return response()->json(['success' => true], 200);
                }
                return response()->json(['success' => false, 'error' => __('Product not found')], 404);

            }
            return response()->json(['success' => false, 'error' => __('Product not found')], 404);
        }
        return back();

    }

}

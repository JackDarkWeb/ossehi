<?php

namespace App\Http\Controllers\Gallery;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\GalleryRepositoryContract;
use App\Repositories\Contracts\StoreProductRepositoryContract;
use App\Repositories\Contracts\StoreRepositoryContract;
use App\Services\GalleryService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class GalleryStoreProductController extends Controller
{
    use GalleryService;

    protected StoreProductRepositoryContract $storeProductRepository;
    protected StoreRepositoryContract $storeRepository;
    protected GalleryRepositoryContract $galleryRepository;

    public function __construct(StoreProductRepositoryContract $storeProductRepository, StoreRepositoryContract $storeRepository, GalleryRepositoryContract $galleryRepository)
    {
        $this->middleware('auth');

        $this->storeProductRepository = $storeProductRepository;
        $this->storeRepository = $storeRepository;
        $this->galleryRepository = $galleryRepository;
    }


    public function formGalleryStoreProduct($lang, $slug){

        $product = $this->storeProductRepository->findBySlug($slug);

        if (!$product){

            return back();
        }

        $store = $this->storeRepository->findByStoreProductAndUser($product);

        if (!$store){

            return back();
        }

        return view('gallery.gallery-store-product',[
            'product' => $product
        ]);

    }


    protected function requestGalleryStoreProduct(Request $request, $lang, $slug){

        $product = $this->storeProductRepository->findBySlug($slug);

        $this->requestGallery($request, $product, $this->storeProductRepository,'store_products_galleries');
    }


    /**
     * @param Request $request
     * @return JsonResponse|RedirectResponse
     */
    public function treatmentImageStoreProduct(Request $request){

        return $this->treatmentImage($request, 'store_products_galleries');
    }




    protected function destroyGalleryProduct($lang, $id){

        if (request()->ajax()){

            $image = $this->galleryRepository->findById($id);

            if ($image){

                $this->galleryRepository->destroy($image);

                return response()->json(['success' => true], 200);
            }
            return response()->json(['success' => false, 'error' => 'Image not found'], 404);
        }

        return back();
    }
}

<?php

namespace App\Http\Controllers\Gallery;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\GalleryRepositoryContract;
use App\Repositories\Contracts\ProductRepositoryContract;
use App\Services\GalleryService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class GalleryProductController extends Controller
{
    use GalleryService;

    protected ProductRepositoryContract $productRepository;
    protected GalleryRepositoryContract $galleryRepository;

    public function __construct(ProductRepositoryContract $productRepository, GalleryRepositoryContract $galleryRepository)
    {
        $this->middleware('auth');

        $this->productRepository = $productRepository;
        $this->galleryRepository = $galleryRepository;

    }

    /**
     * @param $lang
     * @param $slug
     * @return Application|Factory|RedirectResponse|View
     */
    public function formGalleryProduct($lang, $slug){

        $product = $this->productRepository->findProductByUser($slug);

        if (!$product){

            return back();
        }

        return view('gallery.gallery-product',[
            'product' => $product
        ]);
    }


    /**
     * @param Request $request
     * @param $lang
     * @param $slug
     */
    protected function requestGalleryProduct(Request $request, $lang, $slug){

        $product = $this->productRepository->findProductByUser($slug);

        $this->requestGallery($request, $product, $this->productRepository,'products_galleries');
    }

    /**
     * @param $lang
     * @param $id
     * @return JsonResponse|RedirectResponse
     */
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



    /**
     * @param Request $request
     * @return JsonResponse|RedirectResponse
     */
    public function treatmentImageProduct(Request $request){

        return $this->treatmentImage($request, 'products_galleries');
    }



}

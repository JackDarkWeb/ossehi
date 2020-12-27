<?php

namespace App\Http\Controllers\Gallery;


use App\Http\Controllers\Controller;

use App\Repositories\Contracts\StoreRepositoryContract;
use App\Services\GalleryService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;


class GalleryStoreController extends Controller
{
    use GalleryService;

    protected StoreRepositoryContract $storeRepository;

    public function __construct(StoreRepositoryContract $storeRepository)
    {
        $this->middleware('auth');

        $this->storeRepository = $storeRepository;
    }


    /**
     * @param Request $request
     * @return JsonResponse|RedirectResponse
     */
    public function treatmentImageStore(Request $request){

        return $this->treatmentImage($request, 'stores');
    }

}

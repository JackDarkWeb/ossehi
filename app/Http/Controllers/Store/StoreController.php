<?php

namespace App\Http\Controllers\Store;

use App\Helpers\Auth;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\StoreProductRepositoryContract;
use App\Repositories\Contracts\StoreRepositoryContract;
use App\Services\Contracts\RedisServiceContract;
use App\Services\StoreService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class StoreController extends Controller
{
    protected StoreRepositoryContract $storeRepository;
    protected StoreService $storeService;
    protected StoreProductRepositoryContract $storeProductRepository;
    protected RedisServiceContract $redisService;

    public function __construct(StoreRepositoryContract $storeRepository, StoreService $storeService, StoreProductRepositoryContract $storeProductRepository, RedisServiceContract $redisService)
    {
        //$this->middleware('auth');

        $this->storeRepository = $storeRepository;
        $this->storeProductRepository = $storeProductRepository;
        $this->storeService = $storeService;
        $this->redisService = $redisService;
    }

    /**
     * @return Application|Factory|RedirectResponse|View
     */
    public function formStore(){

        if (request()->ajax()){

            return view('store.create-store');
        }
        return  back();
    }


    /**
     * @param Request $request
     * @return JsonResponse|RedirectResponse
     */
    public function createStore(Request $request){

        if ($request->ajax()){

            $errors = $this->storeService->storeFormRequest($request);

            if (!is_null($errors)){

                return response()->json(['success' => false, 'message' => $errors], 400);
            }

            $this->storeRepository->create($request);

            $this->redisService->incrementCounterOperationUser(Auth::id(), 'store_counter');

            return response()->json(['success' => true], 201);

        }
        return back();
    }

    /**
     * @return Application|Factory|View
     */
    public function allStoresByUser(){

        $stores = $this->storeRepository->getAllByUser();

        return view('store.all',[

            'stores' => $stores
        ]);
    }

    /**
     * @param $lang
     * @param $slug
     * @return Application|Factory|RedirectResponse|View
     */
    public function singleStore($lang, $slug){

        $store = $this->storeRepository->findStoreByUSer($slug);

        if ($store){

            $products = $this->storeProductRepository->getStoreProductsByStore($store);

            return view('management.store-product.products',[

                'products' => $products
            ]);
        }
        return back();
    }

    /**
     * @return mixed
     */
    public function allStores(){

        return $this->storeRepository->getAll();
    }

    /**
     * @param $lang
     * @param $slug
     * @return Application|Factory|JsonResponse|RedirectResponse|View
     */
    public function editStore($lang, $slug){

        if (request()->ajax()){

            $store = $this->storeRepository->findStoreByUSer($slug);

            if ($store){

                return view('store.edit-store', [
                    'store' => $store
                ]);
            }
            return response()->json(['success' => false, 'error' => __('Store not found')], 404);
        }
        return back();
    }

    public function updateStore(Request $request, $lang, $slug){

        if ($request->ajax()) {

            $errors = $this->storeService->storeFormRequest($request);

            if (!is_null($errors)) {

                return response()->json(['success' => false, 'message' => $errors], 400);
            }

            $store = $this->storeRepository->findStoreByUSer($slug);

            if ($store){

                $this->storeRepository->update($store, $request);

                return response()->json(['success' => true], 200);
            }
            return response()->json(['success' => false, 'error' => __('Store not found')], 404);
        }
        return back();
    }

    /**
     * @param $lang
     * @param $slug
     * @return JsonResponse|RedirectResponse
     */
    public function destroyStore($lang, $slug){

        if (request()->ajax()){

            $store = $this->storeRepository->findStoreByUSer($slug);

            if ($store){

                $this->storeRepository->destroy($store);

                $this->storeProductRepository->destroyByStore($store);

                $this->redisService->decrementCounterOperationUser(Auth::id(), 'store_counter');

                return response()->json(['success' => true], 200);
            }
            return response()->json(['success' => false, 'error' => __('Store not found')], 404);
        }
        return back();
    }

}

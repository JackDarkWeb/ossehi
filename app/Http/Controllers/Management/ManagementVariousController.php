<?php

namespace App\Http\Controllers\Management;

use App\Helpers\Auth;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\GalleryRepositoryContract;
use App\Repositories\Contracts\VariousRepositoryContract;
use App\Services\Contracts\RedisServiceContract;
use App\Services\VariousService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ManagementVariousController extends Controller
{

    protected VariousRepositoryContract $variousRepository;
    protected VariousService $variousService;
    protected GalleryRepositoryContract $galleryRepository;
    protected RedisServiceContract $redisService;

    public function __construct(VariousRepositoryContract $variousRepository, VariousService $variousService, GalleryRepositoryContract $galleryRepository, RedisServiceContract $redisService)
    {
        $this->middleware('auth');

        $this->variousRepository  = $variousRepository;
        $this->variousService     = $variousService;
        $this->galleryRepository  = $galleryRepository;
        $this->redisService = $redisService;
    }

    /**
     * @return Application|Factory|RedirectResponse|View
     */
    public function formVarious(){

        if (request()->ajax()){

            return view('management.various.create-various');
        }
        return back();
    }

    /**
     * @param Request $request
     * @return JsonResponse|RedirectResponse
     */
    public function createVarious(Request $request){


        if ($request->ajax()){

            $errors = $this->variousService->variousFormRequest($request);

            if (!is_null($errors)){

                return response()->json(['success' => false, 'messages' => $errors], 400);
            }

            $various = $this->variousRepository->create($request);

            $this->variousRepository->createGalleries($various);

            $this->redisService->incrementCounterOperationUser(Auth::id(), 'various_counter');

            return response()->json(['success' => true, 'slug' => $various->slug], 201);

        }
        return back();
    }


    /**
     * @return mixed
     */
    public function variouses(){

        $variouses = $this->variousRepository->getAllByUser();

        return view('management.various.variouses',[
            'variouses' => $variouses
        ]);
    }

    /**
     * @param $lang
     * @param $various_id
     * @param $slug
     * @param $price
     * @param $devise
     * @return Application|Factory|RedirectResponse|View
     */
    public function formDiscount($lang, $various_id, $slug, $price, $devise){

        if (request()->ajax()){

            return view('management.various.discount-form',[
                'various_id' => $various_id,
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
     * @param $various_id
     * @param $slug
     * @param $price
     * @param $devise
     * @return JsonResponse
     */
    public function addDiscount(Request $request, $lang, $various_id, $slug, $price, $devise){

        if ($request->ajax()){

            $various = $this->variousRepository->findVariousByUser($slug);

            if ($various){

                $this->variousRepository->updateDiscount($various, $request);

                return response()->json(['success' => true, 'old_price' => $various->price_various_with_devise, 'discount_price' => $various->price_discount_with_devise, 'routeCancelDiscountName' => route('cancel.discount.various', ['lang' => app()->getLocale(), 'various_id' => $various_id, 'slug' => $slug])], 200);
            }
            return response()->json(['success' => false, 'error' => __('Product not found')], 404);
        }

    }


    /**
     * @param $lang
     * @param $various_id
     * @param $slug
     * @return JsonResponse|RedirectResponse
     */
    public function cancelDiscount($lang, $various_id, $slug){

        if (request()->ajax()){

            $various = $this->variousRepository->findVariousByUser($slug);

            if ($various){

                $this->variousRepository->cancelDiscount($various);

                return response()->json(['success' => true], 200);
            }
            return response()->json(['success' => false, 'error' => __('Product not found')], 404);
        }
        return back();
    }


    /**
     * @param $lang
     * @param $various_id
     * @param $slug
     * @return Application|Factory|RedirectResponse|View
     */
    public function editVarious($lang, $various_id, $slug){

        if (request()->ajax()){

            $various = $this->variousRepository->findVariousByUser($slug);

            return view('management.various.edit-various',[
                'various' => $various
            ]);
        }
        return  back();
    }

    /**
     * @param Request $request
     * @param $lang
     * @param $various_id
     * @param $slug
     * @return JsonResponse|RedirectResponse
     */
    public function updateVarious(Request $request, $lang, $various_id, $slug){


        if ($request->ajax()){

            $errors = $this->variousService->variousFormRequest($request);

            if (!is_null($errors)){

                return response()->json(['success' => false, 'messages' => $errors], 400);
            }

            $various = $this->variousRepository->findVariousByUser($slug);

            if ($various){

                $this->variousRepository->update($various, $request);

                return response()->json(['success' => true], 200);
            }
            return response()->json(['success' => false, 'error' => __('Product not found')], 404);
        }
        return back();
    }


    /**
     * @param $lang
     * @param $various_id
     * @param $slug
     * @return JsonResponse|RedirectResponse
     */
    public function destroyVarious($lang, $various_id, $slug){

        if (request()->ajax()){

            $various = $this->variousRepository->findVariousByUser($slug);

            if ($various){

                $this->variousRepository->destroy($various);

                $this->galleryRepository->destroys($various);

                $this->redisService->decrementCounterOperationUser(Auth::id(), 'various_counter');

                return response()->json(['success' => true], 200);
            }
            return response()->json(['success' => false, 'error' => __('Product not found')], 404);
        }
        return back();

    }


}

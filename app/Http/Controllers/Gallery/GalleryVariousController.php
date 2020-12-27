<?php

namespace App\Http\Controllers\Gallery;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\GalleryRepositoryContract;
use App\Repositories\Contracts\VariousRepositoryContract;
use App\Services\GalleryService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class GalleryVariousController extends Controller
{

    use GalleryService;


    protected VariousRepositoryContract $VariousRepository;
    protected GalleryRepositoryContract $galleryRepository;

    public function __construct(VariousRepositoryContract $VariousRepository, GalleryRepositoryContract $galleryRepository)
    {
        $this->middleware('auth');

        $this->VariousRepository = $VariousRepository;
        $this->galleryRepository = $galleryRepository;

    }

    /**
     * @param $lang
     * @param $slug
     * @return Application|Factory|RedirectResponse|View
     */
    public function formGalleryVarious($lang, $slug){

        $various = $this->VariousRepository->findVariousByUser($slug);

        if (!$various){

            return back();
        }

        return view('gallery.gallery-various',[
            'various' => $various
        ]);
    }


    /**
     * @param Request $request
     * @param $lang
     * @param $slug
     */
    protected function requestGalleryVarious(Request $request, $lang, $slug){

        $product = $this->VariousRepository->findVariousByUser($slug);

        $this->requestGallery($request, $product, $this->VariousRepository,'variouses_galleries');
    }

    protected function destroyGalleryVarious($lang, $id){

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
    public function treatmentImageVarious(Request $request){

        return $this->treatmentImage($request, 'variouses_galleries');
    }

}

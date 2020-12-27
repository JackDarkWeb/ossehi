<?php


namespace App\Services;


use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

trait GalleryService
{

    /**
     * @param Request $request
     * @param string $folderGalleries
     * @return JsonResponse|RedirectResponse
     */
    protected function treatmentImage(Request $request, string $folderGalleries){

        if($request->ajax()){

            $validate  = Validator::make($request->all(),[
                'file' => ['required', 'image', 'max:3000']
            ]);

            if($validate->fails()){

                return response()->json(['success' => false, 'error' => $validate->errors()->first('file')]);
            }

            $image      = $request->file('file');

            $ext = strtolower($image->getClientOriginalExtension());

            $basename =  sha1(time());

            $original   = "{$basename}.{$ext}";

            $image_name = $image->move($folderGalleries, $original)->getFilename();


            return response()->json(['success' => true, 'image_name' => $folderGalleries.'/'.$image_name], 200);

        }
        return back();
    }


    /**
     * @param $request
     * @param $product
     * @param $repository
     * @param string $folderGalleries
     */
    protected function requestGallery($request, $product, $repository, string $folderGalleries){

        $images = Collection::wrap($request->file('file'));


        $images->each(function ($image) use ($product, $repository, $folderGalleries){

            $ext = strtolower($image->getClientOriginalExtension());

            if (!in_array($ext, ['png', 'gif', 'jpeg', 'jpg'])) {

                return response()->json(['success' => false, 'message' => 'Not image'], 400);
            }

            $basename =  sha1(time());

            $original  = "{$basename}.{$ext}";

            $image->move($folderGalleries, $original);

            $full_image = "{$folderGalleries}/{$original}";

            $repository->createGalleries($product, $full_image);

        });

    }

    /**
     * @param $product
     * @return mixed|string
     */
    protected function getPrincipalImageName($product){

        $image_name = explode('/', $product->image);

        return end($image_name);
    }
}

<?php


namespace App\Repositories\Eloquents;


use App\Models\Gallery;
use App\Repositories\Contracts\GalleryRepositoryContract;
use Illuminate\Support\Facades\File;

class GalleryRepository implements GalleryRepositoryContract
{

    /**
     * @param $id
     * @return mixed
     */
    public function findById($id)
    {
        return Gallery::where('id', $id)->first();
    }

    /**
     * @param Gallery $gallery
     * @return bool|mixed|null
     * @throws \Exception
     */
    public function destroy(Gallery $gallery)
    {
       File::delete($gallery->name);

       return $gallery->delete();
    }

    /**
     * @param $product
     * @return mixed
     */
    public function destroyByProduct($product)
    {
        foreach ($product->galleries as $gallery){

            File::delete($gallery->name);
        }

        return $product->galleries()->delete();
    }
}

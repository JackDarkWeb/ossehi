<?php


namespace App\Repositories\Contracts;


use App\Models\Gallery;

interface GalleryRepositoryContract
{

    /**
     * @param $id
     * @return mixed
     */
    public function findById($id);

    /**
     * @param Gallery $gallery
     * @return mixed
     */
    public function destroy(Gallery $gallery);

    /**
     * @param $product
     * @return mixed
     */
    public function destroyByProduct($product);
}

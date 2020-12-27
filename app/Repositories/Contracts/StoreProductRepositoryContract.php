<?php


namespace App\Repositories\Contracts;

use App\Models\Store;
use App\Models\StoreProduct;

interface StoreProductRepositoryContract
{
    /**
     * @param Store $store
     * @return mixed
     */
    public function getStoreProductsByStore(Store $store);

    /**
     * @param Store $store
     * @return mixed
     */
    public function findStoreProductByStore(Store $store);

    /**
     * @param $slug
     * @return mixed
     */
    public function findBySlug($slug);

    /**
     * @param $id
     * @return mixed
     */
    public function findById($id);

    /**
     * @param $store
     * @param $feature
     * @return mixed
     */
    public function countFeatureProduct(Store $store, $feature);

    /**
     * @param StoreProduct $storeProduct
     * @return mixed
     */
    public function getCommentsByStoreProduct(StoreProduct $storeProduct);


    /**
     * @param StoreProduct $storeProduct
     * @param $request
     * @return mixed
     */
    public function createCommentOnThisStoreProduct(StoreProduct $storeProduct, $request);

    /**
     * @param Store $store
     * @param $request
     * @return mixed
     */
    public function create(Store $store, $request);

    /**
     * @param StoreProduct $storeProduct
     * @param null $full_image
     * @return mixed
     */
    public function createGalleries(StoreProduct $storeProduct, $full_image = null);

    /**
     * @param StoreProduct $product
     * @param $request
     * @return mixed
     */
    public function update(StoreProduct $product, $request);

    /**
     * @param StoreProduct $storeProduct
     * @param $request
     * @return mixed
     */
    public function updateDiscount(StoreProduct  $storeProduct, $request);

    /**
     * @param StoreProduct $storeProduct
     * @return mixed
     */
    public function cancelDiscount(StoreProduct $storeProduct);

    /**
     * @param StoreProduct $storeProduct
     * @return mixed
     */
    public function destroy(StoreProduct $storeProduct);

    /**
     * @param Store $store
     * @return mixed
     */
    public function destroyByStore(Store $store);


}

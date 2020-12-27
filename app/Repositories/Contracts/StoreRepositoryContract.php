<?php


namespace App\Repositories\Contracts;


use App\Models\Store;
use App\Models\StoreProduct;

interface StoreRepositoryContract
{

    /**
     * @param $request
     * @return mixed
     */
    public function create($request);

    /**
     * @return mixed
     */
    public function getAll();


    /**
     * @param $take
     * @return mixed
     */
    public function getByParts($take);


    /**
     * @return mixed
     */
    public function getCount();

    /**
     * @param $store_slug
     * @return mixed
     */
    public function findStoreByUSer($store_slug);

    /**
     * @return mixed
     */
    public function getCounterByUser();

    /**
     * @return mixed
     */
    public function getAllByUser();

    /**
     * @param $slug
     * @return mixed
     */
    public function findBySlug($slug);

    /**
     * @param StoreProduct $storeProduct
     * @return mixed
     */
    public function findByStoreProduct(StoreProduct $storeProduct);

    /**
     * @param StoreProduct $storeProduct
     * @return mixed
     */
    public function findByStoreProductAndUser(StoreProduct $storeProduct);

    /**
     * @param Store $store
     * @return mixed
     */
    public function destroy(Store $store);

    /**
     * @param Store $store
     * @param $request
     * @return mixed
     */
    public function update(Store $store, $request);
}

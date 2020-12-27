<?php


namespace App\Repositories\Contracts;


use App\Models\StoreProduct;

interface CartRepositoryContract
{
    /**
     * @return mixed
     */
    public function getAll();

    /**
     * @param $id
     * @return mixed
     */
    public function getById($id);

    /**
     * @return mixed
     */
    public function getCounter();

    /**
     * @return mixed
     */
    public function getTotals();

    /**
     * @return mixed
     */
    public function getTotalsWithDevise();


    /**
     * @param StoreProduct $storeProduct
     * @param $request
     * @return mixed
     */
    public function add(StoreProduct $storeProduct, $request);

    /**
     * @return mixed
     */
    public function clean();


    /**
     * @param string $id
     * @return mixed
     */
    public function remove(string $id);

    /**
     * @param float $tax
     * @return mixed
     */
    public function getTotalsAndTax(float $tax);

    /**
     * @param float $tax
     * @return mixed
     */
    public function getTotalsAndTaxWithDevise(float $tax);
}

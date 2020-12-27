<?php


namespace App\Repositories\Contracts;


interface ShippingOrderRepositoryContract
{
    /**
     * @param $request
     * @return mixed
     */
    public function create($request);
}

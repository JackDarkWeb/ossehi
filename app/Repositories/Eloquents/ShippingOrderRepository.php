<?php


namespace App\Repositories;


use App\Helpers\Auth;
use App\Models\ShippingOrder;

class ShippingOrderRepository implements ShippingOrderRepositoryContract
{

    /**
     * @param $request
     * @return mixed
     */
    public function create($request)
    {
        return ShippingOrder::create([

            'user_id' => Auth::id(),

            'product' => json_encode($request->get('product')),

            'qty_product' => $request->get('qty_product'),

            'product_color' => $request->get('product_color'),

            'product_size' => $request->get('product_size'),

            'address' => json_encode([
                'first_name' => $request->get('first_name'),
                'last_name' => $request->get('last_name'),
                'street' => $request->get('street'),
                'country' => $request->get('country'),
                'state' => $request->get('state'),
                'postal_code' => $request->get('postal_code'),
                'phone' => $request->get('phone'),
                'city' => $request->get('city'),
            ], true),

            'save_address' => (int)$request->get('save_address')
        ]);
    }
}

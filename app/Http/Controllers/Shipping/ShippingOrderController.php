<?php

namespace App\Http\Controllers\Shipping;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\ShippingOrderRepositoryContract;
use App\Services\ShippingOrderService;
use Illuminate\Http\Request;

class ShippingOrderController extends Controller
{
    protected ShippingOrderService $shippingOrderService;
    protected ShippingOrderRepositoryContract $shippingOrderRepository;

    public function __construct(ShippingOrderService $shippingOrderService, ShippingOrderRepositoryContract $shippingOrderRepository)
    {
        $this->shippingOrderService = $shippingOrderService;
        $this->shippingOrderRepository = $shippingOrderRepository;
    }

    function store(Request $request){

        $errors = $this->shippingOrderService->shippingOrderFormRequest($request);

        if (!is_null($errors)){
            return response()->json(['success' => false, 'messages' => $errors], 400);
        }

        $order = $this->shippingOrderRepository->create($request);

        if ($request->get('save_address')){

            $shipping_address = cookie('shipping_address', $order->address);

            return response()->json(['success' => true, 'message' => __("Thanks :name, we have received your message. We will get back to you in 24 hours maximum", ['name' => "<strong>{$request->get('first_name')}</strong>"])], 200)->withCookie($shipping_address);
        }
        return response()->json(['success' => true, 'message' => __("Thanks :name, we have received your message. We will get back to you in 24 hours maximum", ['name' => "<strong>{$request->get('first_name')}</strong>"])], 200);
    }
}

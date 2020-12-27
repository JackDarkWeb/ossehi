<?php

namespace App\Http\Controllers\Cart;

use App\Http\Controllers\Controller;

use App\Repositories\Contracts\CartRepositoryContract;
use App\Repositories\Contracts\StoreProductRepositoryContract;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CartController extends Controller
{
    protected CartRepositoryContract $cartRepository;
    protected StoreProductRepositoryContract $storeProductRepository;

   public function __construct(CartRepositoryContract $cartRepository, StoreProductRepositoryContract $storeProductRepository)
   {
       $this->cartRepository = $cartRepository;
       $this->storeProductRepository = $storeProductRepository;
   }


   function showCart()
   {
       $items = $this->cartRepository->getAll();

       return view('cart.cart', [
           'items' => $items
       ]);
   }

    /**
     * @param Request $request
     * @return JsonResponse|RedirectResponse
     */
   public function addCart(Request $request)
   {

       if ($request->ajax()){

           $product = $this->storeProductRepository->findById($request->get('product_id'));

           if ($product){

               $add = $this->cartRepository->add($product, $request);

               if (!$add){

                   return response()->json(['success' => false, 'message' => __('Error server')], 500);
               }

               return response()->json(['success' => true, 'message' => __('The product has been successfully added'), 'rawId' => $add->rawId()], 201);
           }
           return response()->json(['success' => false, 'message' => __('The product not found')], 404);
       }
       return back();
   }

   public function destroyCart($lang, $rowId){

       if (request()->ajax()){

           $item = $this->cartRepository->getById($rowId);

           if ($item){

               $this->cartRepository->remove($rowId);

               return response()->json(['success' => true, 'message' => __('The product has been deleted')], 200);
           }

           return response()->json(['success' => false, 'message' => __('The product not found')], 404);
       }
       return back();
   }


    /**
     * @return RedirectResponse
     */
   public function cleanCart(){

       $this->cartRepository->clean();

       return back();
   }
}

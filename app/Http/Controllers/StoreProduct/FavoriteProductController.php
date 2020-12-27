<?php

namespace App\Http\Controllers\StoreProduct;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\FavoriteProductRepositoryContract;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class FavoriteProductController extends Controller
{
    protected FavoriteProductRepositoryContract $favoriteProductRepository;


    public function __construct(FavoriteProductRepositoryContract $favoriteProductRepository)
    {
        $this->favoriteProductRepository = $favoriteProductRepository;
    }

    function getAll(){

        if (Cookie::has('user_favorite')){

            $user_favorite = Cookie::get('user_favorite');

            $products = $this->favoriteProductRepository->getByUser($user_favorite);

            //dd($products);
            return view('storeProduct.favorites-products', [
                'products' => $products
            ]);
        }
        return back();
    }

    /**
     * @param Request $request
     * @return JsonResponse|RedirectResponse
     */
    public function addFavoriteProduct(Request $request){

        if ($request->ajax()){

            if (!Cookie::has('user_favorite')){

                $user_favorite = $this->favoriteProductRepository->userFavorite();

                $this->favoriteProductRepository->createWithUserFavorite($request, $user_favorite);

                $cookie_favorite = cookie('user_favorite', $user_favorite);

                return response()->json(['success' => true], 201)->withCookie($cookie_favorite);
            }

            $user_favorite = Cookie::get('user_favorite');

            $found = $this->favoriteProductRepository->findByProductIdAndUser($user_favorite, $request->get('product_id'));

            if ($found){
                return response()->json(['success' => false], 202);
            }

            $this->favoriteProductRepository->create($request, $user_favorite);

            return response()->json(['success' => true], 201);
        }
        return back();
    }

    /**
     * @param $lang
     * @param $id
     * @return JsonResponse|RedirectResponse
     */
    public function destroyFavoriteProduct($lang, $id){

        if (request()->ajax()){

            $user_favorite = Cookie::get('user_favorite');

            $product = $this->favoriteProductRepository->findByProductIdAndUser($user_favorite, $id);

            if ($product){

                ($this->favoriteProductRepository->destroy($user_favorite, $id));

                return response()->json(['success' => true], 200);
            }

            return response()->json(['success' => false], 404);
        }
        return back();
    }
}

<?php


namespace App\Repositories\Eloquents;


use App\Models\FavoriteProduct;
use App\Repositories\Contracts\FavoriteProductRepositoryContract;

class FavoriteProductRepository implements FavoriteProductRepositoryContract
{

    /**
     * @param $user_favorite_id
     * @return mixed
     */
    public function getByUser($user_favorite_id)
    {
        return FavoriteProduct::where('user_favorite_id', $user_favorite_id)
                                ->latest()
                                ->paginate(8);
    }

    /**
     * @param $user_favorite_id
     * @return mixed
     */
    public function getCounter($user_favorite_id){
        return FavoriteProduct::where('user_favorite_id', $user_favorite_id)->count();
    }

    /**
     * @param $request
     * @param $user_favorite
     * @return mixed
     */
    public function create($request, $user_favorite)
    {
        return FavoriteProduct::create([
            'user_favorite_id' => $user_favorite,
            'product_id' => $request->get('product_id'),
            'product' => json_encode($request->get('product'))
        ]);
    }

    /**
     * @param $user_favorite
     * @param $id
     * @return mixed
     */
    public function destroy($user_favorite, $id)
    {
        return FavoriteProduct::where('user_favorite_id', $user_favorite)
                               ->where('product_id', $id)
                               ->delete();
    }

    /**
     * @param $user_favorite_id
     * @return mixed
     */
    public function findByUser($user_favorite_id)
    {
        return FavoriteProduct::where('user_favorite_id')->count();
    }

    /**
     * @param $user_favorite_id
     * @param $product_id
     * @return mixed
     */
    public function findByProductIdAndUser($user_favorite_id, $product_id)
    {
        return FavoriteProduct::where('user_favorite_id', $user_favorite_id)
                                ->where('product_id', $product_id)
                                ->first();
    }

    /**
     * @param $request
     * @param $user_favorite
     * @return mixed
     */
    public function createWithUserFavorite($request, $user_favorite)
    {
        return FavoriteProduct::create([
            'user_favorite_id' => $user_favorite,
            'product_id' => $request->get('product_id'),
            'product' => json_encode($request->get('product'))
        ]);
    }

    public function userFavorite(){

        return FavoriteProduct::getUserFavoriteId();
    }
}

<?php


namespace App\Repositories\Contracts;


interface FavoriteProductRepositoryContract
{
    /**
     * @param $user_favorite_id
     * @return mixed
     */
    public function getByUser($user_favorite_id);

    /**
     * @param $user_favorite_id
     * @return mixed
     */
    public function getCounter($user_favorite_id);

    /**
     * @param $user_favorite_id
     * @return mixed
     */
    public function findByUser($user_favorite_id);

    /**
     * @param $user_favorite_id
     * @param $product_id
     * @return mixed
     */
    public function findByProductIdAndUser($user_favorite_id, $product_id);

    /**
     * @param $request
     * @param $user_favorite
     * @return mixed
     */
    public function create($request, $user_favorite);

    /**
     * @param $request
     * @param $user_favorite
     * @return mixed
     */
    public function createWithUserFavorite($request, $user_favorite);

    /**
     * @param $user_favorite
     * @param $id
     * @return mixed
     */
    public function destroy($user_favorite, $id);

    /**
     * @return mixed
     */
    public function userFavorite();



}

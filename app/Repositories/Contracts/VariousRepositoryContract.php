<?php


namespace App\Repositories\Contracts;


use App\Models\Various;

interface VariousRepositoryContract
{
    /**
     * @return mixed
     */
    public function getAll();

    /**
     * @param $type
     * @return mixed
     */
    public function getAllByType($type);

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
     * @param $type
     * @param $take
     * @return mixed
     */
    public function getByType($type, $take);

    /**
     * @param $skip
     * @param $take
     * @return mixed
     */
    public function getByRandomOrder($skip, $take);

    /**
     * @param Various $various
     * @return mixed
     */
    public function getCommentsByVarious(Various $various);


    /**
     * @param Various $various
     * @param $request
     * @return mixed
     */
    public function createCommentOnThisVarious(Various $various, $request);

    /**
     * @param $slug
     * @return mixed
     */
    public function findVariousByUser($slug);

    /**
     * @return mixed
     */
    public function getAllByUser();

    /**
     * @return mixed
     */
    public function getCounterByUser();


    /**
     * @param $request
     * @return mixed
     */
    public function create($request);

    /**
     * @param Various $various
     * @param $request
     * @return mixed
     */
    public function update(Various $various, $request);

    /**
     * @param Various $various
     * @param $request
     * @return mixed
     */
    public function updateDiscount(Various $various, $request);

    /**
     * @param Various $various
     * @return mixed
     */
    public function cancelDiscount(Various $various);

    /**
     * @param Various $various
     * @param null $full_image
     * @return mixed
     */
    public function createGalleries(Various $various, $full_image = null);

    /**
     * @param Various $various
     * @return mixed
     */
    public function destroy(Various $various);
}

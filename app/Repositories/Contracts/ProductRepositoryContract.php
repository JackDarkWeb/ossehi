<?php


namespace App\Repositories\Contracts;


use App\Models\Category;
use App\Models\Product;

interface ProductRepositoryContract
{
    /**
     * @return mixed
     */
    public function getAll();

    /**
     * @param $slug
     * @return mixed
     */
    public function findBySlug($slug);

    /**
     * @param Category $category
     * @param $sub_category_name
     * @return mixed
     */
    public function getProductsBySubCategory(Category $category,$sub_category_name);

    /**
     * @param $skip
     * @param $take
     * @return mixed
     */
    public function getProductsVip($skip, $take);

    /**
     * @param $skip
     * @param $take
     * @return mixed
     */
    public function getProductsByParts($skip, $take);

    /**
     * @param $feature
     * @return mixed
     */
    public function countFeatureProduct($feature);

    /**
     * @param Product $product
     * @param $request
     * @return mixed
     */
    public function createCommentOnThisProduct(Product $product, $request);

    /**
     * @param Product $product
     * @return mixed
     */
    public function getCommentsByProduct(Product $product);

    /**
     * @param $id
     * @return mixed
     */
    public function findById($id);

    /**
     * @param $slug_product
     * @return mixed
     */
    public function findProductByUser($slug_product);

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
     * @param Product $product
     * @param $request
     * @return mixed
     */
    public function update(Product $product, $request);

    /**
     * @param Product $product
     * @param $request
     * @return mixed
     */
    public function updateDiscount(Product $product, $request);

    /**
     * @param Product $product
     * @return mixed
     */
    public function cancelDiscount(Product $product);

    /**
     * @param Product $product
     * @param null $full_image
     * @return mixed
     */
    public function createGalleries(Product $product, $full_image = null);

    /**
     * @param Product $product
     * @return mixed
     */
    public function destroy(Product $product);


}

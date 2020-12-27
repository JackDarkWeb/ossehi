<?php


namespace App\Repositories\Contracts;


use App\Models\Product;

interface CategoryRepositoryContract
{
    /**
     * @return mixed
     */
    public function getCategoriesProducts();

    /**
     * @return mixed
     */
    public function getCategoriesPosts();

    /**
     * @param $name
     * @return mixed
     */
    public function findByName($name);

    /**
     * @param Product $product
     * @return mixed
     */
    public function findById(Product $product);

    /**
     * @return mixed
     */
    public function getSubCategoriesProducts();
}

<?php


namespace App\Repositories\Eloquents;


use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;
use App\Repositories\Contracts\CategoryRepositoryContract;
use Illuminate\Database\Eloquent\Builder;

class CategoryRepository implements CategoryRepositoryContract
{

    /**
     * @return mixed
     */
    public function getCategoriesProducts()
    {
        return Category::has('sub_categories')
                        ->with('sub_categories')
                        ->orderBy('name')
                        ->get();
    }

    /**
     * @return mixed
     */
    public function getCategoriesPosts()
    {
        return Category::has('posts')->orderBy('name')->get();
    }

    /**
     * @param $name
     * @return mixed
     */
    public function findByName($name)
    {
        return Category::has('sub_categories')
                        ->with('sub_categories')
                        ->where('name', $name)
                        ->first();
    }


    /**
     * @param Product $product
     * @return mixed
     */
    public function findById(Product $product)
    {
        return Category::whereHas('sub_categories', function (Builder $query) use ($product){
                $query->where('id', $product->parent_id);
            })->first();
    }

    /**
     * @return mixed
     */
    public function getSubCategoriesProducts()
    {
        return SubCategory::OrderBy('name')->get();
    }
}

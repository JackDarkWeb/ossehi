<?php


namespace App\Repositories\Eloquents;


use App\Helpers\Auth;
use App\Models\Category;
use App\Models\Product;
use App\Repositories\Contracts\ProductRepositoryContract;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ProductRepository implements ProductRepositoryContract
{

    /**
     * @return mixed
     */
    public function getAll()
    {
        Return Product::with('sub_categories')
                      ->orderBy('price')
                      ->latest()
                      ->get();
    }

    /**
     * @param Category $category
     * @param $sub_category_name
     * @return mixed|void
     */
    public function getProductsBySubCategory(Category $category, $sub_category_name)
    {
        return Product::whereHas('sub_categories', function (Builder $query) use ($category, $sub_category_name){

            $query->where('category_id', $category->id)
                  ->where('name' , $sub_category_name);

        })->latest()
          ->paginate(9);
    }

    /**
     * @param $slug
     * @return mixed
     */
    public function findBySlug($slug)
    {
        Return Product::with(['sub_categories', 'galleries'])
                        ->where('slug', $slug)
                        ->first();
    }

    /**
     * @param $skip
     * @param $take
     * @return mixed
     */
    public function getProductsVip($skip, $take)
    {
        return Product::with(['galleries', 'comments'])
            ->where('type', 'VIP')
            ->inRandomOrder()->skip($skip)
            ->take($take)
            ->latest()
            ->get();
    }


    /**
     * @param $skip
     * @param $take
     * @return mixed
     */
    public function getProductsByParts($skip, $take)
    {
        return Product::with('galleries')
            ->inRandomOrder()->skip($skip)
            ->take($take)
            ->latest()
            ->get();
    }

    /**
     * @param $feature
     * @return mixed
     */
    public function countFeatureProduct($feature)
    {
        return Product::where(function (Builder $query) use ($feature){

            $query->where('brands', 'like', "%$feature%")
                ->orWhere('colors', 'like', "%$feature%")
                ->orWhere('sizes', 'like', "%$feature%");
        })->count();
    }


    /**
     * @param $id
     * @return mixed
     */
    public function findById($id)
    {
        return Product::with(['galleries', 'user'])
            ->where(function (Builder $query) use ($id){
                $query->where('id', $id);
            })->first();
    }

    /**
     * @param Product $product
     * @return Collection|\Illuminate\Support\Collection|mixed
     */
    public function getCommentsByProduct(Product $product)
    {
        return $product->comments()->with('user')
            ->latest()
            ->get()
            ->map(function ($comment){
                return (object)[
                    'body' => $comment->body,
                    'user_id' => $comment->user_id,
                    'user_name_profile' => $comment->user->user_name_profile,
                    'user_name' => $comment->user->user_name,
                    'date' => $comment->date_comment
                ];
            });
    }

    /**
     * @param Product $product
     * @param $request
     * @return Model|mixed
     */
    public function createCommentOnThisProduct(Product $product, $request)
    {
        return $product->comments()->create([
            'user_id' => Auth::id(),
            'body'    => $request->get('body')
        ]);
    }

    /**
     * @param $slug_product
     * @return mixed
     */
    public function findProductByUser($slug_product)
    {
        return $this->formatRelationQuery()
                    ->where('slug', $slug_product)
                    ->first();

        /*return Product::where('user_id', Auth::id())
                        ->where('slug', $slug_product)
                        ->first();**/
    }

    /**
     * @return mixed
     */
    public function getAllByUser()
    {
        /*return $this->formatRelationQuery()
                   ->latest()
                   ->paginate(9);**/

        return Product::where('user_id', Auth::id())
                       ->latest()
                       ->paginate(9);
    }

    /**
     * @return mixed
     */
    public function getCounterByUser()
    {
        return $this->getAllByUser()->total();
    }

    /**
     * @param $request
     * @return mixed
     */
    public function create($request)
    {
        return $this->formatRelationQuery()->create([

            'parent_id'   => (int)$request->get('category'),
            'title'       => $request->get('title'),
            'slug'        => Str::slug(Str::random().'-'.$request->get('title')),
            'description' => $request->get('description'),
            'price'       => (float)$request->get('price'),
            'devise'      => $request->get('devise'),
            'image'       => $request->get('image'),
            'type'        => $request->get('type'),
            'colors'      => json_encode($request->get('colors'), true),
            'sizes'       => json_encode($request->get('sizes'), true),
            'brands'      => json_encode($request->get('brands'), true)
        ]);

    }

    /**
     * @param Product $product
     * @param $full_image
     * @return Model
     */
    public function createGalleries(Product $product, $full_image = null)
    {
        return $product->galleries()->create([
            'name' => $full_image ? $full_image : $product->image
        ]);
    }

    /**
     * @param Product $product
     * @param $request
     * @return mixed
     */
    public function update(Product $product, $request)
    {
        return $product->update([

            'parent_id'   => (int)$request->get('category'),
            'title'       => $request->get('title'),
            'slug'        => Str::slug(Str::random().'-'.$request->get('title')),
            'description' => $request->get('description'),
            'price'       => $request->get('price') ?? $product->price,
            'devise'      => $request->get('devise') ?? $product->devise,
            'image'       => $request->get('image'),
            'type'        => $request->get('type'),
            'colors'      => json_encode($request->get('colors'), true),
            'sizes'       => json_encode($request->get('sizes'), true),
            'brands'      => json_encode($request->get('brands'), true)
        ]);
    }


    protected function formatRelationQuery(){

        return Auth::user()->products();
    }

    /**
     * @param Product $product
     * @param $request
     * @return mixed
     */
    public function updateDiscount(Product $product, $request)
    {
        return $product->update([
            'discount_price' => $request->get('discount_price')
        ]);
    }

    /**
     * @param Product $product
     * @return mixed
     */
    public function cancelDiscount(Product $product)
    {
        return $product->update([
            'discount_price' => null
        ]);
    }

    /**
     * @param Product $product
     * @return mixed
     * @throws \Exception
     */
    public function destroy(Product $product)
    {
        File::delete($product->image);

        return $product->delete();
    }
}

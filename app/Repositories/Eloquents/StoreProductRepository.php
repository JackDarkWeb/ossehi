<?php


namespace App\Repositories\Eloquents;


use App\Helpers\Auth;
use App\Models\Store;
use App\Models\StoreProduct;
use App\Repositories\Contracts\StoreProductRepositoryContract;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class StoreProductRepository implements StoreProductRepositoryContract
{

    /**
     * @param Store $store
     * @return mixed
     */
    public function getStoreProductsByStore(Store $store)
    {

        return $store->store_products()
                     ->latest()
                     ->paginate(10);

        /*return StoreProduct::with('galleries')
                            ->where(function (Builder $query) use ($store){
                                $query->where('store_productable_id', $store->id);
                            })->latest()
                              ->paginate(10);**/
    }

    /**
     * @param $slug
     * @return mixed
     */
    public function findBySlug($slug)
    {
        return StoreProduct::with('galleries')
                           ->where(function (Builder $query) use ($slug){
                                 $query->where('slug', $slug);
                           })->first();
    }

    /**
     * @param $store
     * @param $feature
     * @return mixed
     */
    public function countFeatureProduct($store, $feature)
    {
        return $store->store_products()->where(function (Builder $query) use ($feature){

            $query->where('brands', 'like', "%$feature%")
                ->orWhere('colors', 'like', "%$feature%")
                ->orWhere('sizes', 'like', "%$feature%");
        })->count();

       /*return StoreProduct::where(function (Builder $query) use ($feature){

           $query->where('brands', 'like', "%$feature%")
                   ->orWhere('colors', 'like', "%$feature%")
                   ->orWhere('sizes', 'like', "%$feature%");
       })
           ->Where('store_productable_id', $store->id)
           ->count();**/
    }

    /**
     * @param $id
     * @return mixed
     */
    public function findById($id)
    {
        return StoreProduct::with('galleries')
            ->where(function (Builder $query) use ($id){
                $query->where('id', $id);
            })->first();
    }


    /**
     * @param StoreProduct $storeProduct
     * @return mixed
     */
    public function getCommentsByStoreProduct(StoreProduct $storeProduct)
    {
        return $storeProduct->comments()->with('user')
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
     * @param StoreProduct $storeProduct
     * @param $request
     * @return mixed
     */
    public function createCommentOnThisStoreProduct(StoreProduct $storeProduct, $request)
    {
        return $storeProduct->comments()->create([
            'user_id' => Auth::id(),
            'body'    => $request->get('body')
        ]);
    }

    /**
     * @param Store $store
     * @return mixed
     */
    public function findStoreProductByStore(Store $store)
    {
        return $store->store_products()->first();

        /*return StoreProduct::where(function (Builder $query) use ($store){
                   $query->where('store_productable_id', $store->id);
               })->first();*/
    }

    /**
     * @param Store $store
     * @param $request
     * @return mixed
     */
    public function create(Store $store, $request)
    {
       return $store->store_products()->create([

           'title'       => $request->get('title'),
           'slug'        => Str::slug(Str::random().'-'.$request->get('title')),
           'description' => $request->get('description'),
           'price'       => (float)$request->get('price'),
           'devise'      => $request->get('devise'),
           'image'       => $request->get('image'),
           'colors'      => json_encode($request->get('colors'), true),
           'sizes'       => json_encode($request->get('sizes'), true),
           'brands'      => json_encode($request->get('brands'), true)
       ]);
    }


    /**
     * @param StoreProduct $storeProduct
     * @param null $full_image
     * @return mixed
     */
    public function createGalleries(StoreProduct $storeProduct, $full_image = null)
    {
        return $storeProduct->galleries()->create([

            'name' => $full_image ? $full_image : $storeProduct->image
        ]);
    }


    /**
     * @param StoreProduct $product
     * @param $request
     * @return mixed
     */
    public function update(StoreProduct $product, $request)
    {
        return $product->update([

            'title'       => $request->get('title'),
            'slug'        => Str::slug(Str::random().'-'.$request->get('title')),
            'description' => $request->get('description'),
            'price'       => $request->get('price') ?? $product->price,
            'devise'      => $request->get('devise') ?? $product->devise,
            'image'       => $request->get('image'),
            'colors'      => json_encode($request->get('colors'), true),
            'sizes'       => json_encode($request->get('sizes'), true),
            'brands'      => json_encode($request->get('brands'), true)
        ]);
    }

    /**
     * @param StoreProduct $storeProduct
     * @param $request
     * @return mixed
     */
    public function updateDiscount(StoreProduct $storeProduct, $request)
    {
        return $storeProduct->update([
            'discount_price' => $request->get('discount_price')
        ]);
    }

    /**
     * @param StoreProduct $storeProduct
     * @return mixed
     */
    public function cancelDiscount(StoreProduct $storeProduct)
    {
        return $storeProduct->update([
            'discount_price' => null
        ]);
    }

    /**
     * @param StoreProduct $storeProduct
     * @return mixed
     * @throws \Exception
     */
    public function destroy(StoreProduct $storeProduct)
    {
        File::delete($storeProduct->image);

        return $storeProduct->delete();
    }

    /**
     * @param Store $store
     * @return mixed
     */
    public function destroyByStore(Store $store)
    {

        foreach ($store->store_products as $store_product){

            File::delete($store_product->image);
        }

        return $store->store_products()->delete();
    }
}

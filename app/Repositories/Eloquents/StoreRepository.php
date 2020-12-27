<?php


namespace App\Repositories\Eloquents;


use App\Helpers\Auth;
use App\Models\Store;
use App\Models\StoreProduct;
use App\Repositories\Contracts\StoreRepositoryContract;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class StoreRepository implements StoreRepositoryContract
{

    /**
     * @return mixed
     */
    public function getAll()
    {
        return Store::orderBy('name')->get();
    }

    /**
     * @param $slug
     * @return mixed
     */
    public function findBySlug($slug)
    {
        return Store::with('store_products')->where('slug', $slug)->first();
    }



    /**
     * @return mixed
     */
    public function getCount()
    {
        return Store::count();
    }

    /**
     * @param $storeProduct
     * @return mixed
     */
    public function findByStoreProduct($storeProduct)
    {
        return Store::whereHas('store_products', function (Builder $query) use ($storeProduct){
            $query->where('slug', $storeProduct->slug);
        })->first();
    }

    /**
     * @param $take
     * @return mixed
     */
    public function getByParts($take)
    {
        return Store::latest()->take($take)->get();
    }

    /**
     * @param $request
     * @return mixed
     */
    public function create($request)
    {
        return Auth::user()
                    ->stores()
                    ->create([
                            'name' => $request->get('name'),
                            'slug' => Str::slug(Str::random().'-'.$request->get('name')),
                            'slogan' => $request->get('slogan'),
                            'image' => $request->get('image')
                    ]);
        /*return Store::create([
            'user_id' => Auth::id(),
            'name' => $request->get('name'),
            'slug' => Str::slug($request->get('name')),
            'slogan' => $request->get('slogan'),
            'image' => $request->get('image')
        ]);**/
    }

    /**
     * @param $store_slug
     * @return mixed
     */
    public function findStoreByUSer($store_slug)
    {
        return $this->getAllByUser()
                    ->where('slug', $store_slug)
                    ->first();

        /*return Store::where('user_id', Auth::id())
                    ->where('slug', $store_slug)
                    ->first();**/

    }

    /**
     * @return mixed
     */
    public function getCounterByUser()
    {
        return $this->getAllByUser()->count();
    }

    /**
     * @return mixed
     */
    public function getAllByUser()
    {
        return Store::where('user_id', Auth::id())
                     ->get();
    }

    /**
     * @param StoreProduct $storeProduct
     * @return mixed
     */
    public function findByStoreProductAndUser(StoreProduct $storeProduct)
    {
        $store = $this->findByStoreProduct($storeProduct);

        if (!$store){

            return null;
        }

        return $this->findStoreByUSer($store->slug);
    }

    /**
     * @param Store $store
     * @return mixed
     * @throws \Exception
     */
    public function destroy(Store $store)
    {
        File::delete($store->image);

        return $store->delete();
    }

    /**
     * @param Store $store
     * @param $request
     * @return mixed
     */
    public function update(Store $store, $request)
    {
        return $store->update([
            'name' => $request->get('name'),
            'slug' => Str::slug(Str::random().'-'.$request->get('name')),
            'slogan' => $request->get('slogan'),
            'image' => $request->get('image')
        ]);
    }
}

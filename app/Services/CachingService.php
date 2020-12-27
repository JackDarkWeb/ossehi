<?php


namespace App\Services;



use App\Repositories\Eloquents\CategoryRepository;
use App\Repositories\Eloquents\StoreRepository;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Cookie;

class CachingService
{
    use ApiService;


    /**
     * @param $price
     * @param string $devise_base
     * @return float|int
     */
    static function convertCurrency($price, $devise_base = 'USD')
    {
        $out_devise = Cookie::get('devise') ?? $devise_base;

        $price_in_devise_base = $price / CachingService::dataCurrencyStorageInCache()['rates'][$devise_base];

        return $price_in_devise_base*CachingService::dataCurrencyStorageInCache()['rates'][$out_devise];
    }

    /**
     * @return mixed
     */
    public static function dataCategoriesProductsStorageInCache(){

        return Cache::remember('data_categories_products', now()->addSeconds(86400), function (){

            return (new CategoryRepository)->getCategoriesProducts();
        });
    }


    /**
     * @return mixed
     */
    public static function dataSubCategoriesProductsStorageInCache(){

        return Cache::remember('data_sub_categories_products', now()->addSeconds(86400), function (){

            return (new CategoryRepository)->getSubCategoriesProducts();
        });
    }

    /**
     * @return mixed
     */
    public static function dataStoresStorageInCache(){

        return Cache::remember('data_stores', now()->addSeconds(86400), function (){

            return (new StoreRepository)->getAll();
        });
    }

    /**
     * @return mixed
     */
    public static function dataCategoriesPostsStorageInCache(){

        return Cache::remember('data_categories_posts', now()->addSeconds(86400), function (){

            return (new CategoryRepository)->getCategoriesPosts();
        });
    }

    /**
     * @return mixed
     */
    protected static function dataCurrencyStorageInCache(){

        return  Cache::remember('data_currency', now()->addSeconds(86400000), function (){
            return self::apiDevise('EUR');
        });
    }

}

<?php


use App\Helpers\Auth;
use App\Helpers\Helper;
use App\Repositories\Eloquents\CartRepository;
use App\Repositories\Eloquents\FavoriteProductRepository;
use App\Repositories\Eloquents\ProductRepository;
use App\Repositories\Eloquents\StoreProductRepository;
use App\Repositories\Eloquents\StoreRepository;
use App\Repositories\Eloquents\VariousRepository;
use App\Services\CachingService;
use App\Services\RedisService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;



if (!function_exists('carts')){

    function carts(){

        return (new CartRepository)->getAll();
    }
}

if (!function_exists('totals_of_cart')){

    function totals_of_cart(){

        return (new CartRepository)->getTotalsWithDevise();
    }
}

if (!function_exists('totals_of_cart_with_tax')){

    function totals_of_cart_with_tax(float $tax){

        return (new CartRepository)->getTotalsAndTaxWithDevise($tax);
    }
}

if (!function_exists('counter_of_cart')){
    /**
     * @return mixed
     */
    function counter_of_cart(){

        return (new CartRepository)->getCounter();
    }
}





if (!function_exists('get_products_vip')){
    /**
     * @param $skip
     * @param $take
     * @return mixed
     */
    function get_products_vip($skip, $take){
        return (new ProductRepository)->getProductsVip($skip, $take);
    }
}

if (!function_exists('get_products_by_parts')){
    /**
     * @param $skip
     * @param $take
     * @return mixed
     */
    function get_products_by_parts($skip, $take){
        return (new ProductRepository)->getProductsByParts($skip, $take);
    }
}

if (!function_exists('get_various_type')){
    /**
     * @param $type
     * @param $take
     * @return mixed
     */
    function get_various_type($type, $take){
        return (new VariousRepository)->getByType($type, $take);
    }
}

if (!function_exists('get_various_by_random')){
    /**
     * @param $skip
     * @param $take
     * @return Builder[]|Collection|mixed
     */
    function get_various_by_random($skip, $take){
        return (new VariousRepository)->getByRandomOrder($skip, $take);
    }
}




if(!function_exists('change_language')){

    /**
     * @param string $redirect_lang
     * @return string
     */
    function change_language(string $redirect_lang){

        $request_uri = explode('/', ($_SERVER['REQUEST_URI']));
        $request_uri[1] = $redirect_lang;

        return implode('/', $request_uri);
    }
}


if(!function_exists('route_name')){
    /**
     * @param $routeName
     * @param array $params
     * @return string
     */
    function route_name($routeName, $params = []){

        if (!isset($params['slug']) && !isset($params['name']) && !isset($params['id']))
            return route($routeName,['lang' => app()->getLocale()]);

        if (!isset($params['name']) && !isset($params['id']) && isset($params['slug']))
            return route($routeName,['lang' => app()->getLocale(), 'slug' => $params['slug']]);

        if (isset($params['name']) && !isset($params['id']) && !isset($params['slug']))
            return route($routeName,['lang' => app()->getLocale(), 'name' => $params['name']]);

        if (!isset($params['name']) && isset($params['id']) && !isset($params['slug']))
            return route($routeName,['lang' => app()->getLocale(), 'id' => $params['id']]);

        return route($routeName,['lang' => app()->getLocale(), 'name' => $params['name'], 'slug' => $params['slug'], 'id' => $params['id'],]);
    }
}

if(!function_exists('menu_active')){

    function menu_active($name){

        $route_name = Route::currentRouteName();

        if(isset($route_name) && $route_name === $name){

            return (object)['class' => 'active', 'style' => "style=color:#fe696a"];
        }

        return (object)['class' => '', 'style' => ""];
    }
}
if (!function_exists('get_prefix_phone')){
    /**
     * @param null $country
     * @return string
     */
    function get_prefix_phone($country = null){
        return Helper::prefixPhone($country);
    }
}

if (!function_exists('countries')){
    /**
     * @return mixed
     */
    function countries(){
        return Helper::getCountries();
    }
}

if (!function_exists('country_active')){
    /**
     * @param $country
     * @return string
     */
    function country_active($country){
        return Helper::userLocation()->country === $country ? 'selected' : '';
    }
}

if(!function_exists('menu_category_products')){
    /**
     * @return mixed
     */
    function menu_category_products(){
        return CachingService::dataCategoriesProductsStorageInCache();
    }
}

if(!function_exists('menu_category_blog')){
    /**
     * @return mixed
     */
    function menu_category_blog(){

        return CachingService::dataCategoriesPostsStorageInCache();
    }
}

if(!function_exists('menu_sub_category_products')){
    /**
     * @return mixed
     */
    function menu_sub_category_products(){

        return CachingService::dataSubCategoriesProductsStorageInCache();
    }
}


if(!function_exists('menu_store')){
    /**
     * @return mixed
     */
    function menu_store(){

        return (new StoreRepository)->getAll();
    }
}

if(!function_exists('count_store')){
    /**
     * @return mixed
     */
    function count_store(){

        return (new StoreRepository)->getCount();
    }
}

if(!function_exists('counts')){
    /**
     * @return mixed
     */
    function counts(){

        return (new RedisService)->getCounterOperationUser(Auth::id());

        return (object)[
            'store' => (new StoreRepository)->getCount(),
            'store_by_user' => (new StoreRepository)->getCounterByUser(),
            'product_by_user' => (new ProductRepository)->getCounterByUser(),
            'various_by_user' => (new VariousRepository)->getCounterByUser()
        ];
    }
}

if (!function_exists('stores_by_user')){
    /**
     * @return mixed
     */
    function stores_by_user(){

        return (new StoreRepository)->getAllByUser();
    }
}

if (!function_exists('products_by_user')){
    /**
     * @return mixed
     */
    function products_by_user(){

        return (new ProductRepository)->getAllByUser();
    }
}

if(!function_exists('stock_colors')){
    /**
     * @param null $colors
     * @return array
     */
    function stock_colors($colors = null){
        if(!is_null($colors)){
            return explode(';', $colors);
        }
        return [
                 "Black" => "#000",
                 "Blue" => "#0188cc",
                 "Green" => "#81d742",
                 "Indigo" => "#6085a5",
                 "Red" => "#ab6e6e",
                 "Brown" => "#ddb373",
                 "Light-Blue" => "#6b97bf",
                 "Yellow" => "#eded68",
                 "White" => "#ffffff",
              ];
    }
}

if(!function_exists('stock_sizes')){
    /**
     * @param null $sizes
     * @return array
     */

    function stock_sizes($sizes = null){
        if(!is_null($sizes)){
            return explode(';', $sizes);
        }
        return ['S','M','L', 'XL','2XL','3Xl'];
    }
}

if(!function_exists('stock_brands')){
    /**
     * @return string[]
     */
    function stock_brands(){

      $brands = [
          'Adidas', 'Camel', 'Seiko', 'Samsung Galaxy', 'Sony',
          "Zara", "Pull&Pear", "iPhone","Nokia","BMW","Nissan","Mercedes BENZ",
          "HONDA-MOTO"
      ];
      sort($brands);

        return $brands;
    }
}

if(!function_exists('devises')){
    /**
     * @return array
     */
    function devises(){

        return ['USD', 'EUR', 'XOF', 'UAH', 'NGN' ];
    }
}

if(!function_exists('count_feature_store_product')){
    /**
     * @param $store
     * @param $feature
     * @return mixed
     */
    function count_feature_store_product($store, $feature){
        return (new StoreProductRepository)->countFeatureProduct($store, $feature);
    }
}


if(!function_exists('count_feature_product')){
    /**
     * @param $feature
     * @return mixed
     */
    function count_feature_product($feature){
        return (new ProductRepository)->countFeatureProduct($feature);
    }
}

if (!function_exists('favorites_products_count')){
    /**
     * @return int|mixed
     */
    function favorites_products_count(){

        if (Cookie::has('user_favorite')){

            $user_favorite = Cookie::get('user_favorite');

            return (new FavoriteProductRepository)->getCounter($user_favorite);

        }
        return 0;

    }
}

if (!function_exists('cast_cookie')){

    function cast_cookie($key_cookie){

        if (Cookie::has($key_cookie)){

            return (object)json_decode(Cookie::get($key_cookie), true);
        }
        return null;
    }
}


if (!function_exists('favorite_product')){
    /**
     * @param int $product_id
     * @return string
     */
    function favorite_product(int $product_id){

        if (Cookie::has('user_favorite')){

            $user_favorite = Cookie::get('user_favorite');

            $product = (new FavoriteProductRepository)->findByProductIdAndUser($user_favorite, $product_id);

            return $product ? 'bg-success' : '';
        }
        return '';
    }
}




if(!function_exists('comma_separator')){

    /**
     * @param $fields
     * @return string
     */
    function comma_separator($fields){

        if(gettype($fields) === 'string'){

            $fields = explode(' ', $fields);
        }

        $values = '';
        $x      = 1;

        foreach ($fields as $field){

            if(gettype($field) === 'array'){

                foreach ($field as $f){
                    $values .=  $f;

                    if($x < count($field)){

                        $values .= ', ';
                    }
                    $x++;
                }
            }else{

                $values .=  $field;

                if($x < count($fields)){

                    $values .= ', ';
                }
                $x++;
            }
        }

        return $values;
    }
}

if(!function_exists('pluralize')){

    /**
     * @param string $singular
     * @return string
     */
    function pluralize(string $singular){

        if($singular === 'day'){
            return 'days';
        }

        $last_letter = strtolower($singular[strlen($singular)-1]);

        switch($last_letter) {
            case 'y':
                return substr($singular,0,-1).'ies';
            case 's':
                return $singular.'es';
            default:
                return $singular.'s';
        }
    }
}

if(!function_exists('plural')){
    /**
     * @param int $count
     * @param string $singular
     * @return string
     */
    function plural(int $count, string $singular){

        if($count == 1 || $count == 0){
            $tr = __($singular);
            return "{$count} {$tr}";
        }

        $tr = __(pluralize($singular));

        return "{$count} {$tr}";
    }
}

if(!function_exists('plurals')){
    /**
     * @param $count
     * @param $string
     * @return string
     */
    function plurals($count, $string){

        return $count.' '.Str::plural(__($string), $count == 0 ? 1 : $count);
    }
}






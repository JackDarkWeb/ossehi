<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
|
*/

Route::pattern('lang', 'en|fr');

Route::redirect('/', 'en');

Route::group(['prefix' => '{lang}'], function () {

    App::setLocale(Request::segment(1));

    Route::get('/', 'HomeController@home')->name('home');

    Route::get('contact', 'ContactController@showContactForm')->name('contact');
    Route::post('contact', 'ContactController@store')->name('contact.store');

    Route::get('about-us', 'AboutUsController@showAboutUs')->name('about');

    Route::post('helpers', 'HelperController@setCookieDevise')->name('set.cookie.devise');
    Route::post('helpers/states', 'HelperController@getStateByCountry')->name('states');
    Route::post('helpers/stop-newsletter-pop', 'HelperController@setCookieStopNewsLetterPop')->name('set.cookie.newsletter');

    Route::get('favorites/products', 'StoreProduct\FavoriteProductController@getAll')->name('favorite.product');
    Route::post('add-product-favorite', 'StoreProduct\FavoriteProductController@addFavoriteProduct')->name('add.favorite.product');
    Route::delete('delete-product-favorite/{id}', 'StoreProduct\FavoriteProductController@destroyFavoriteProduct')->name('destroy.favorite.product');

    Route::post('newsletter/create', 'Notify\\NewsLetterController@create')->name('newsletter.create');

    Route::get('login-popup', 'Auth\\LoginController@showLoginForm')->name('login');
    Route::post('login-popup', 'Auth\\LoginController@store')->name('login.store');

    Route::get('logout','Auth\\LogoutController@loggedOut')->name('logout');

    Route::post('register', 'Auth\\RegisterController@store')->name('register.store');

    Route::post('password/forgot', 'Auth\\ForgotPasswordController@store')->name('password.email');

    Route::get('password/reset/{slug}','Auth\\ResetPasswordController@showPasswordResetForm')->name('reset.password');
    Route::put('password/reset/{slug}','Auth\\ResetPasswordController@store')->name('password.update');

    Route::get('blog', 'Post\PostController@allPosts')->name('posts');
    Route::get('blog/{slug}', 'Post\PostController@single')->name('posts.single');



    Route::get('blog/category/{slug}', 'Category\CategoryController@posts')->name('posts.category');
    Route::get('product/category/{slug}', 'Category\CategoryController@products')->name('products.category');

    Route::get('search/{q?}', 'Search\\SearchController@searchPosts')->name('search.post');




    Route::get('comments/{post_id}', 'Comment\\CommentController@fetchComment')->name('comments.fetch');
    Route::post('comments', 'Comment\\CommentController@store')->name('comments.store');

    Route::get('comments/product/{product_id}', 'Comment\\CommentController@fetchCommentProduct')->name('comments.product.fetch');
    Route::post('comments/product', 'Comment\\CommentController@product')->name('comments.product');

    Route::get('comments/various/{various_id}', 'Comment\\CommentController@fetchCommentVarious')->name('comments.various.fetch');
    Route::post('comments/various', 'Comment\\CommentController@various')->name('comments.various');

    Route::get('comments/store_product/{store_product_id}', 'Comment\\CommentController@fetchCommentStoreProduct')->name('comments.store_product.fetch');
    Route::post('comments/store_product', 'Comment\\CommentController@storeProduct')->name('comments.store_product');


    Route::post('shipping/order', 'Shipping\\ShippingOrderController@store')->name('shipping.store');



    Route::post('shopping/cart/add', 'Cart\\CartController@addCart')->name('cart.add');
    Route::delete('shopping/cart/destroy/{destroy}', 'Cart\\CartController@destroyCart')->name('cart.destroy');

    Route::middleware('auth')->group(function (){

        Route::get('dashboard', 'DashBoard\\DashBoardController@showDashBoard')->name('dashboard');

        Route::put('dashboard', 'UserController@updateUser')->name('update.user');

        Route::get('my account', 'DashBoard\\DashBoardController@showInformationAccount')->name('account');


        Route::get('shopping/cart', 'Cart\\CartController@showCart')->name('cart');
        Route::delete('shopping/cart/clean', 'Cart\\CartController@cleanCart')->name('cart.clean');


        Route::get('user/stores', 'Store\\StoreController@allStoresByUser')->name('stores.by_user');
        Route::get('user/stores/{slug}', 'Store\\StoreController@singleStore')->name('stores.single.by_user');
        Route::get('create/store', 'Store\\StoreController@formStore')->name('create.store');
        Route::post('create/store', 'Store\\StoreController@createStore')->name('request.store');

        Route::get('edit/store/{slug}', 'Store\\StoreController@editStore')->name('edit.store');
        Route::put('update/store/{slug}', 'Store\\StoreController@updateStore')->name('update.store');
        Route::delete('destroy/store/{slug}', 'Store\\StoreController@destroyStore')->name('destroy.store');


        Route::get('user/products', 'Management\\ManagementProductController@products')->name('products.by_user');
        Route::get('create/product', 'Management\\ManagementProductController@formProduct')->name('create.product');
        Route::post('create/product', 'Management\\ManagementProductController@requestProduct')->name('request.product');
        Route::get('discount/product/{product_id}/{slug}/{price}/{devise}', 'Management\\ManagementProductController@formDiscount')->name('discount.product');
        Route::put('discount/product/{product_id}/{slug}/{price}/{devise}', 'Management\\ManagementProductController@addDiscount')->name('request.discount');
        Route::put('cancel/discount/product/{product_id}/{slug}', 'Management\\ManagementProductController@cancelDiscount')->name('cancel.discount');

        Route::get('edit/product/{product_id}/{slug}', 'Management\\ManagementProductController@editProduct')->name('edit.product');
        Route::put('update/product/{product_id}/{slug}', 'Management\\ManagementProductController@updateProduct')->name('update.product');
        Route::delete('destroy/product/{product_id}/{slug}', 'Management\\ManagementProductController@destroyProduct')->name('destroy.product');

        Route::get('create/store/product/{slug}', 'Management\\ManagementStoreProductController@formProduct')->name('create.store.product');
        Route::post('create/store/product/{slug}', 'Management\\ManagementStoreProductController@createProduct')->name('request.store.product');
        Route::get('discount/store/product/{product_id}/{slug}/{price}/{devise}', 'Management\\ManagementStoreProductController@formDiscount')->name('discount.store_product');
        Route::put('discount/store/product/{product_id}/{slug}/{price}/{devise}', 'Management\\ManagementStoreProductController@addDiscount')->name('request.discount.store_product');

        Route::put('cancel/discount/store/product/{product_id}/{slug}', 'Management\\ManagementStoreProductController@cancelDiscount')->name('cancel.discount.store_product');

        Route::get('edit/store/product/{product_id}/{slug}', 'Management\\ManagementStoreProductController@editProduct')->name('edit.store_product');
        Route::put('update/store/product/{product_id}/{slug}', 'Management\\ManagementStoreProductController@updateProduct')->name('update.store_product');
        Route::delete('destroy/store/product/{product_id}/{slug}', 'Management\\ManagementStoreProductController@destroyProduct')->name('destroy.store_product');



        Route::get('user/diversities', 'Management\\ManagementVariousController@variouses')->name('variouses.by_user');
        Route::get('create/diversity', 'Management\\ManagementVariousController@formVarious')->name('create.various');
        Route::post('create/diversity', 'Management\\ManagementVariousController@createVarious')->name('request.various');
        Route::get('discount/diversity/{various_id}/{slug}/{price?}/{devise?}', 'Management\\ManagementVariousController@formDiscount')->name('discount.various');
        Route::put('discount/diversity/{various_id}/{slug}/{price?}/{devise?}', 'Management\\ManagementVariousController@addDiscount')->name('request.discount.various');

        Route::put('cancel/discount/diversity/{various_id}/{slug}', 'Management\\ManagementVariousController@cancelDiscount')->name('cancel.discount.various');

        Route::get('edit/diversity/{various_id}/{slug}', 'Management\\ManagementVariousController@editVarious')->name('edit.various');
        Route::put('update/diversity/{various_id}/{slug}', 'Management\\ManagementVariousController@updateVarious')->name('update.various');
        Route::delete('destroy/diversity/{various_id}/{slug}', 'Management\\ManagementVariousController@destroyVarious')->name('destroy.various');


        Route::get('menus', 'Publish\\PublishController@showMenus')->name('publish.menus');


        Route::post('treatment/store/image', 'Gallery\\GalleryStoreController@treatmentImageStore')->name('treatment.image');

        Route::post('treatment/store-product/image', 'Gallery\\GalleryStoreProductController@treatmentImageStoreProduct')->name('treatment.store_product.image');

        Route::post('treatment/product/image', 'Gallery\\GalleryProductController@treatmentImageProduct')->name('treatment.product.image');

        Route::post('treatment/various/image', 'Gallery\\GalleryVariousController@treatmentImageVarious')->name('treatment.various.image');

        Route::get('galleries/product/{slug}', 'Gallery\\GalleryProductController@formGalleryProduct')->name('gallery.product');
        Route::post('galleries/product/{slug}', 'Gallery\\GalleryProductController@requestGalleryProduct')->name('request.gallery.product');
        Route::delete('destroy/gallery/product/{id}', 'Gallery\\GalleryProductController@destroyGalleryProduct')->name('destroy.gallery.product');

        Route::get('galleries/store/product/{slug}', 'Gallery\\GalleryStoreProductController@formGalleryStoreProduct')->name('gallery.store_product');
        Route::post('galleries/store/product/{slug}', 'Gallery\\GalleryStoreProductController@requestGalleryStoreProduct')->name('request.gallery.store_product');
        Route::delete('destroy/gallery/store/product/{id}', 'Gallery\\GalleryStoreProductController@destroyGalleryProduct')->name('destroy.gallery.store_product');


        Route::get('galleries/diversity/{slug}', 'Gallery\\GalleryVariousController@formGalleryVarious')->name('gallery.various');
        Route::post('galleries/diversity/{slug}', 'Gallery\\GalleryVariousController@requestGalleryVarious')->name('request.gallery.various');
        Route::delete('destroy/gallery/diversity/{id}', 'Gallery\\GalleryVariousController@destroyGalleryVarious')->name('destroy.gallery.various');

    });



    Route::get('stores', 'Store\\StoreController@allStores')->name('stores');


    Route::get('diversities', 'Various\\VariousController@AllVariouses')->name('diversities');
    Route::get('diversity/{slug}', 'Various\\VariousController@singleVarious')->name('diversities.single');
    Route::get('diversities/{name}', 'Various\\VariousController@typeVarious')->name('diversities.type');


    Route::get('store/products/{slug}', 'StoreProduct\\StoreProductController@allProductsStore')->name('store.products');
    Route::get('store/product/{slug}', 'StoreProduct\\StoreProductController@ShowSingleProductStore')->name('store.products.single');
    Route::get('/store-product-quick-view/{slug}', 'StoreProduct\\StoreProductController@quickViewStore')->name('store.product.quick.view');



    Route::get('product/{slug}', 'Product\\ProductController@singleProduct')->name('product');
    Route::get('/product-quick-view/{slug}', 'Product\\ProductController@quickView')->name('product.quick.view');



    Route::get('{category_name}/{sub_category_name}', 'Product\\ProductController@productsSubCategory')->name('products.sub_category');
    Route::get('list/{category_name}/{sub_category_name}', 'Product\\ProductController@productsSubCategory')->name('products.sub_category.list');



});



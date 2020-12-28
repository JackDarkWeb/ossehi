<?php

namespace App\Providers;



use App\Repositories\Contracts\CartRepositoryContract;
use App\Repositories\Contracts\CategoryRepositoryContract;
use App\Repositories\Contracts\FavoriteProductRepositoryContract;
use App\Repositories\Contracts\GalleryRepositoryContract;
use App\Repositories\Contracts\NewsLetterRepositoryContract;
use App\Repositories\Contracts\PostRepositoryContract;
use App\Repositories\Contracts\ProductRepositoryContract;
use App\Repositories\Contracts\ResetPasswordRepositoryContract;
use App\Repositories\Contracts\ShippingOrderRepositoryContract;
use App\Repositories\Contracts\StoreProductRepositoryContract;
use App\Repositories\Contracts\StoreRepositoryContract;
use App\Repositories\Contracts\UserRepositoryContract;
use App\Repositories\Contracts\VariousRepositoryContract;
use App\Repositories\Eloquents\CartRepository;
use App\Repositories\Eloquents\CategoryRepository;
use App\Repositories\Eloquents\FavoriteProductRepository;
use App\Repositories\Eloquents\GalleryRepository;
use App\Repositories\Eloquents\NewsLetterRepository;
use App\Repositories\Eloquents\PostRepository;
use App\Repositories\Eloquents\ProductRepository;
use App\Repositories\Eloquents\ResetPasswordRepository;
use App\Repositories\Eloquents\StoreProductRepository;
use App\Repositories\Eloquents\StoreRepository;
use App\Repositories\Eloquents\UserRepository;
use App\Repositories\Eloquents\VariousRepository;
use App\Repositories\ShippingOrderRepository;
use Illuminate\Support\ServiceProvider;

class RepositoriesServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(PostRepositoryContract::class, PostRepository::class);
        $this->app->bind(ProductRepositoryContract::class, ProductRepository::class);
        $this->app->bind(CategoryRepositoryContract::class, CategoryRepository::class);
        $this->app->bind(StoreRepositoryContract::class, StoreRepository::class);
        $this->app->bind(VariousRepositoryContract::class, VariousRepository::class);
        $this->app->bind(StoreProductRepositoryContract::class, StoreProductRepository::class);
        $this->app->bind(FavoriteProductRepositoryContract::class, FavoriteProductRepository::class);
        $this->app->bind(NewsLetterRepositoryContract::class, NewsLetterRepository::class);
        $this->app->bind(ShippingOrderRepositoryContract::class, ShippingOrderRepository::class);
        $this->app->bind(CartRepositoryContract::class, CartRepository::class);
        $this->app->bind(GalleryRepositoryContract::class, GalleryRepository::class);
        $this->app->bind(UserRepositoryContract::class, UserRepository::class);
        $this->app->bind(ResetPasswordRepositoryContract::class, ResetPasswordRepository::class);
    }
}

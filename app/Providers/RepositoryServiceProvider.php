<?php

namespace App\Providers;


use Illuminate\Support\ServiceProvider;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\Category\CategoryRepository;
use App\Repositories\Product\ProductRepositoryInterface;
use App\Repositories\Product\ProductRepository;
use App\Repositories\User\UserRepositoryInterface;
use App\Repositories\User\UserRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->app->singleton(CategoryRepositoryInterface::class, CategoryRepository::class);
        $this->app->singleton(ProductRepositoryInterface::class, ProductRepository::class);
        $this->app->singleton(UserRepositoryInterface::class, UserRepository::class);
    }
}

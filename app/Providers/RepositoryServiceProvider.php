<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
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
        $this->app->bind(\App\Repositories\Permission\PermissionRepository::class,
            \App\Repositories\Permission\PermissionRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Category\CategoryRepository::class,
            \App\Repositories\Category\CategoryRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\User\UserRepository::class,
            \App\Repositories\User\UserRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Role\RoleRepository::class,
            \App\Repositories\Role\RoleRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Customer\CustomerRepository::class,
            \App\Repositories\Customer\CustomerRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Media\MediaRepository::class,
            \App\Repositories\Media\MediaRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Product\ProductRepository::class,
            \App\Repositories\Product\ProductRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Size\SizeRepository::class,
            \App\Repositories\Size\SizeRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\PasswordReset\PasswordResetRepository::class,
            \App\Repositories\PasswordReset\PasswordResetRepositoryEloquent::class);
        //:end-bindings:
    }
}

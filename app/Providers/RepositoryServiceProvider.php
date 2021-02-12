<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Contracts\{PostInterface, UserInterface};
use App\Repositories\Eloquent\{PostRepository, UserRepository};

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(PostInterface::class, PostRepository::class);
        $this->app->bind(UserInterface::class, UserRepository::class);
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}

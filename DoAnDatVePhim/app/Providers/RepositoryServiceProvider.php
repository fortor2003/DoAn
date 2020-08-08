<?php

namespace App\Providers;

use App\Repositories\ITheLoaiRepository;
use App\Repositories\TheLoaiRepository;
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
        $this->app->bind(ITheLoaiRepository::class, TheLoaiRepository::class);
    }
}

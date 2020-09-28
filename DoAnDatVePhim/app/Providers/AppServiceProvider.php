<?php

namespace App\Providers;

use App\Services\khachHang\GheService;
use App\Services\khachHang\PageService;
use Illuminate\Support\ServiceProvider;
use Yajra\Oci8\Oci8ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(Oci8ServiceProvider::class);
        $this->app->bind(PageService::class, function ($app) {
            return new PageService();
        });
        $this->app->bind(GheService::class, function ($app) {
            return new GheService();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}

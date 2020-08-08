<?php

namespace App\Providers;

use App\Repositories\ITheLoaiRepository;
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

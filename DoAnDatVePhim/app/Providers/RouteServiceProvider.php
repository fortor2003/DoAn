<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespaceKhachHang = 'App\Http\Controllers\khachHang';
    protected $namespaceQuanTri = 'App\Http\Controllers\quanTri';

    /**
     * The path to the "home" route for your application.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();

        //
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        // Route khách hàng [web]
        Route::middleware('web')
            ->namespace($this->namespaceKhachHang)
            ->group(base_path('routes/khach_hang.php'));
        // Route khách hàng [api]
        Route::middleware('api')->prefix('api')
            ->namespace($this->namespaceKhachHang)
            ->group(base_path('routes/khach_hang_api.php'));
        // Route quản trị [web]
        Route::middleware('web')->prefix('admin')
            ->namespace($this->namespaceQuanTri)
            ->group(base_path('routes/quan_tri.php'));
//        Route::middleware('api')->prefix('admin/api')
//            ->namespace($this->namespaceKhachHang)
//            ->group(base_path('routes/khach_hang_api.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
            ->middleware('api')
            ->namespace($this->namespace)
            ->group(base_path('routes/api.php'));
    }
}

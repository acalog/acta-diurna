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
    protected $namespace = 'App\Http\Controllers';

    /**
     * The path to the "home" route for your application.
     *
     * @var string
     */
    public const HOME = '/panel';

    protected $routeGroup = [
        'public' => [
            'middleware' => 'web',
            'namespace' => 'App\Http\Controllers\Content',
        ],
        'auth' => [
            'middleware' => 'web',
            'namespace' => 'App\Http\Controllers',
        ]
    ];

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

        $this->mapPanelRoutes();

        Route::group($this->routeGroup['auth'], function($router) {
            require base_path('routes/auth.php');
        });

        Route::group($this->routeGroup['public'], function($router) {
            require base_path('routes/public.php');
        });

        $this->mapWebRoutes();

    }

    /**
     * Admin Panel routes
     *
     */
    protected function mapPanelRoutes()
    {
        Route::middleware(['web', 'auth'])
            ->namespace($this->namespace . '\Panel')
            ->group(base_path('routes/panel.php'));
    }

    /**
     * Public routes

    protected function mapPublicRoutes()
    {
        Route::middleware(['web'])
            ->namespace($this->namespace)
            ->group(base_path('routes/public.php'));
    }
     * */


    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
             ->namespace($this->namespace)
             ->group(base_path('routes/web.php'));
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

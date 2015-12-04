<?php

namespace Noonic\Image;

use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\Router;

class ImageServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('noonic_image', function() {
            return new ImageHelper;
        });
    }

    public function boot()
    {
        // Routes
        $this->setupRoutes($this->app->router);

        // Config
        $this->mergeConfigFrom(
            __DIR__ . '/config/image.php', 'noonic_image'
        );

        // Views
        $this->loadViewsFrom(__DIR__ . '/views', 'noonic_image');

        // Publish
        $this->publishes([
            __DIR__ . '/config' => config_path('noonic_image'),
            __DIR__ . '/views' => base_path('resources/views/vendor/noonic_image'),
            __DIR__ . '/public' => base_path('public'),
        ]);
    }

    /**
     * Define the routes for the application.
     *
     * @param  \Illuminate\Routing\Router  $router
     * @return void
     */
    public function setupRoutes(Router $router)
    {
        $router->group(['namespace' => 'Noonic\Image\Http\Controllers'], function($router)
        {
            require __DIR__.'/Http/routes.php';
        });
    }
}
<?php

namespace WikiGods\ImageGenerator;

use Illuminate\Support\ServiceProvider;

class ImageGeneratorServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     */
    public function register()
    {
        $this->app->singleton('image-generator', function ($app) {
            return new ImageGenerator(

            );
        });
    }
}
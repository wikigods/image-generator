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
        // Publicar configuración
        $this->publishes([
            __DIR__ . '/../config/image-generator.php' => config_path('image-generator.php'),
        ], 'config');
    }

    /**
     * Register any application services.
     */
    public function register()
    {
        // Merge de configuración por defecto
        $this->mergeConfigFrom(
            __DIR__ . '/../config/image-generator.php', 'image-generator'
        );

        // Registrar el servicio como Singleton
        $this->app->singleton('image-generator', function ($app) {
            return new ImageGenerator(
                $app['filesystem'],
                $app['config']
            );
        });
    }
}
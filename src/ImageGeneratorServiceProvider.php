<?php

namespace WikiGods\ImageGenerator;

use Faker\Generator;
use Illuminate\Support\ServiceProvider;

class ImageGeneratorServiceProvider extends ServiceProvider
{
    /**
     * @var array<string, bool>
     */
    protected static $fakerWithImageProvider = [];

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
            return new ImageGenerator();
        });

        $this->app->afterResolving(Generator::class, function (Generator $faker) {
            $this->registerFakerImageProvider($faker);
        });

        $this->app->afterResolving('faker', function ($faker) {
            if ($faker instanceof Generator) {
                $this->registerFakerImageProvider($faker);
            }
        });
    }

    /**
     * Register the package faker provider once per faker instance.
     */
    protected function registerFakerImageProvider(Generator $faker)
    {
        $hash = spl_object_hash($faker);
        if (isset(self::$fakerWithImageProvider[$hash])) {
            return;
        }

        $faker->addProvider(new FakerImageGeneratorServiceProvider($faker));
        self::$fakerWithImageProvider[$hash] = true;
    }
}

<?php

namespace WikiGods\ImageGenerator\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static string generate(int $width = 600, int $height = 480, string $extension = 'png', string $text = null, string $fontPath = null, int $fontSize = null)
 * * @see \WikiGods\ImageGenerator\ImageGenerator
 */
class ImageGenerator extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'image-generator';
    }
}
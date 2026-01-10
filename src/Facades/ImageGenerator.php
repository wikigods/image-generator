<?php

namespace WikiGods\ImageGenerator\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static string image($dir, $text = null, $fontPath = null, $width = 640, $height = 480, $fullPath = true, $format = 'png')
 * * @see \WikiGods\ImageGenerator\ImageGenerator
 */
class ImageGenerator extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'image-generator';
    }
}
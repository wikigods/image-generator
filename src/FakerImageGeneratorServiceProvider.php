<?php

namespace WikiGods\ImageGenerator;

use Faker\Provider\Base;
use WikiGods\ImageGenerator\ImageGenerator;

class FakerImageGeneratorServiceProvider extends Base
{
    /**
     *
     *
     * @param string|null $dir
     * @param string|null $text
     * @param string|null $fontPath
     * @param int         $width
     * @param int         $height
     * @param bool        $fullPath
     * @param string      $format
     *
     */
    public function image(
        $dir = null,
        $text = null,
        $fontPath = null,
        $width = 640,
        $height = 480,
        $fullPath = true,
        $format = 'png'
    ) {

        return ImageGenerator::image(
            $dir,
            $text,
            $fontPath,
            $width,
            $height,
            $fullPath,
            $format
        );
    }
}
<?php

namespace WikiGods\ImageGenerator;

use Faker\Provider\Base;
use WikiGods\ImageGenerator\ImageGenerator;

class FakerImageGeneratorServiceProvider extends Base
{
    /**
     * Generate an image using Faker's standard image() argument order.
     *
     * The final two arguments are package-specific options for rendering text.
     */
    public function image(
        $dir = null,
        $width = 640,
        $height = 480,
        $fullPath = true,
        $aImageType = null,
        $thumbsDir = null,
        $text = null,
        $fontPath = null,
        $category = 'random',
        $variant = null,
        $name = null
    ) {
        // Keep accepting the package's previous positional signature:
        // image($dir, $text, $fontPath, $width, $height, $fullPath, $format).
        if (!is_numeric($width)) {
            $legacyText = $width;
            $legacyFontPath = $height;
            $legacyWidth = is_numeric($fullPath) ? $fullPath : 640;
            $legacyHeight = is_numeric($aImageType) ? $aImageType : 480;
            $legacyFullPath = is_bool($thumbsDir) ? $thumbsDir : true;
            $legacyFormat = is_string($text) ? $text : 'png';

            $width = $legacyWidth;
            $height = $legacyHeight;
            $fullPath = $legacyFullPath;
            $aImageType = $legacyFormat;
            $text = $legacyText;
            $fontPath = $legacyFontPath;
        }

        if (null !== $name && '' !== $name) {
            $text = $name;
        }

        // Faker calls this argument aImageType; this generator supports png/jpg.
        $format = null === $aImageType ? 'png' : $aImageType;
        if ('jpeg' === strtolower($format)) {
            $format = 'jpg';
        }

        return ImageGenerator::image(
            $dir,
            $text,
            $fontPath,
            $width,
            $height,
            $fullPath,
            $format,
            $category,
            $variant
        );
    }

    /**
     * Generate a Faker-style image for a specific category and optional variant.
     *
     * Example: fake()->categoryImage('computer', $dir, 640, 480, true, 'png', 'ram').
     */
    public function categoryImage($category, $dir = null, $width = 640, $height = 480, $fullPath = true, $aImageType = null, $variant = null, $name = null, $fontPath = null)
    {
        return $this->image($dir, $width, $height, $fullPath, $aImageType, null, $name, $fontPath, $category, $variant);
    }

    /**
     * Generate an image for a random computer component or the requested variant.
     */
    public function computerImage($variant = null, $dir = null, $width = 640, $height = 480, $fullPath = true, $aImageType = null, $name = null, $fontPath = null)
    {
        return $this->image($dir, $width, $height, $fullPath, $aImageType, null, $name, $fontPath, 'computer', $variant);
    }
}

<?php

namespace WikiGods\ImageGenerator;

use WikiGods\ImageGenerator\Categories\CategoryRegistry;

class ImageGenerator
{
    /**
     * Return the supported illustration categories, excluding random background mode.
     *
     * @return array<int, string>
     */
    public static function categories()
    {
        return CategoryRegistry::categories();
    }

    /**
     * Return supported product variants for a category.
     *
     * @return array<int, string>
     */
    public static function variants($category)
    {
        $category = strtolower(str_replace([' ', '-'], '_', strtr(trim((string) $category), [
            'á' => 'a', 'é' => 'e', 'í' => 'i', 'ó' => 'o', 'ú' => 'u', 'ü' => 'u', 'ñ' => 'n',
        ])));
        $aliases = [
            'computadora' => 'computer', 'computadoras' => 'computer', 'tecnologia' => 'computer', 'technology' => 'computer',
            'producto' => 'product', 'productos' => 'product', 'abarrote' => 'food', 'abarrotes' => 'food', 'alimento' => 'food', 'alimentos' => 'food', 'bebida' => 'beverage', 'bebidas' => 'beverage',
            'libro' => 'book', 'libros' => 'book', 'medicina' => 'medicine', 'medicamentos' => 'medicine', 'construccion' => 'construction',
            'casco' => 'helmet', 'arnes' => 'harness', 'carpinteria' => 'carpentry', 'muebles' => 'furniture', 'ropa' => 'clothing',
            'carro' => 'car', 'hoteles' => 'hotel', 'deportes' => 'sports', 'belleza' => 'beauty', 'mascota' => 'pets', 'mascotas' => 'pets',
            'agricultura' => 'agriculture', 'juguetes' => 'toys', 'oficina' => 'office', 'papeleria' => 'office',
        ];

        return CategoryRegistry::variants(isset($aliases[$category]) ? $aliases[$category] : $category);
    }

    /**
     * Generates an image with a random background color and optional multi-line text.
     */
    public static function image(
        $dir = null,
        $text = null,
        $fontPath = null,
        $width = 640,
        $height = 480,
        $fullPath = true,
        $format = 'png',
        $category = 'abstract',
        $variant = null,
        $name = null
    )
    {
        if (null !== $name && '' !== $name) {
            $text = $name;
        }

        $fontSize = 50;

        $im = imagecreatetruecolor($width, $height);


        if (null === $category || (is_string($category) && in_array(strtolower(trim($category)), ['', 'abstract'], true))) {
            $red = rand(0, 255);
            $green = rand(0, 255);
            $blue = rand(0, 255);
            $backgroundColor = imagecolorallocate($im, $red, $green, $blue);
            imagefill($im, 0, 0, $backgroundColor);
        } elseif (!is_string($category)) {
            imagedestroy($im);
            throw new \InvalidArgumentException('Image category must be a string.');
        } else {
            ImageRenderer::drawCategory($im, $width, $height, $category, $variant);
        }


        if ($text && $fontPath && file_exists($fontPath)) {
            $textColor = imagecolorallocate($im, 255, 255, 255);
            $maxWidth = $width - 40;


            $lines = splitTextIntoLines($text, $fontPath, $fontSize, $maxWidth);

            $totalTextHeight = count($lines) * ($fontSize + 10);
            $y = ($height - $totalTextHeight) / 2 + $fontSize;

            foreach ($lines as $line) {
                $bbox = imagettfbbox($fontSize, 0, $fontPath, $line);
                $textWidth = $bbox[2] - $bbox[0];
                $x = round(($width - $textWidth) / 2);
                imagettftext($im, $fontSize, 0, $x, $y, $textColor, $fontPath, $line);
                $y += $fontSize + 10;
            }
        } elseif ($text) {
            ImageRenderer::drawFallbackText($im, $width, $height, $text);
        }

        $dir = null === $dir ? sys_get_temp_dir() : $dir; // GNU/Linux / OS X / Windows compatible


        if (!is_dir($dir) || !is_writable($dir)) {
            throw new \InvalidArgumentException(sprintf('Cannot write to directory "%s"', $dir));
        }

        $generatedName = md5(uniqid(mt_rand(), true));
        $fileName = sprintf('%s.%s', $generatedName, $format);
        $filePath = $dir . DIRECTORY_SEPARATOR . $fileName;

        if ($format == 'png') {
            imagepng($im, $filePath);
        } elseif ($format == 'jpg') {
            imagejpeg($im, $filePath);
        }

        imagedestroy($im);


        return $fullPath ? $filePath : $fileName;
    }

}

<?php

namespace WikiGods\ImageGenerator;

class ImageGenerator
{
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
        $format = 'png'
    )
    {

        $fontSize = 50;

        $im = imagecreatetruecolor($width, $height);


        $red = rand(0, 255);
        $green = rand(0, 255);
        $blue = rand(0, 255);
        $backgroundColor = imagecolorallocate($im, $red, $green, $blue);
        imagefill($im, 0, 0, $backgroundColor);


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
        }

        $dir = null === $dir ? sys_get_temp_dir() : $dir; // GNU/Linux / OS X / Windows compatible


        if (!is_dir($dir) || !is_writable($dir)) {
            throw new \InvalidArgumentException(sprintf('Cannot write to directory "%s"', $dir));
        }

        $name = md5(uniqid(mt_rand(), true)) . '.' . $format;
        $fileName = sprintf('%s.%s', $name, $format);
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
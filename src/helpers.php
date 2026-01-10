<?php

function splitTextIntoLines($text, $fontPath, $fontSize, $maxWidth)
{
    $words = explode(' ', $text);
    $lines = [];
    $currentLine = '';

    foreach ($words as $word) {
        $testLine = $currentLine . ' ' . $word;
        $bbox = imagettfbbox($fontSize, 0, $fontPath, $testLine);
        $lineWidth = $bbox[2] - $bbox[0];

        if ($lineWidth <= $maxWidth) {
            $currentLine = $testLine;
        } else {
            if (!empty($currentLine)) {
                $lines[] = trim($currentLine);
            }
            $currentLine = $word;
        }
    }
    if (!empty($currentLine)) {
        $lines[] = trim($currentLine);
    }
    return $lines;
}

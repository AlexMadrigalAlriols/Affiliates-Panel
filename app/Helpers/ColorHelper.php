<?php

namespace App\Helpers;

class ColorHelper
{
    public static function generateColors($background, $foreground = null)
    {
        $buttonBackground = self::adjustBrightness($background, 50);
        $buttonText = self::getContrastColor($buttonBackground);

        $cards = self::adjustBrightness($background, -60);
        $texts = self::getContrastColor($foreground ?? $cards);
        $foreground = $foreground ? self::adjustBrightness($foreground, -40) : self::getContrastColor($texts);

        return [
            'primary' => $background,
            'secondary' => $foreground,
            'buttonBackground' => $buttonBackground,
            'buttonText' => $buttonText,
            'card' => $cards,
            'texts' => $texts
        ];
    }

    private static function getContrastColor($color)
    {
        $hex = str_replace("#", "", $color);
        $r = hexdec(substr($hex, 0, 2));
        $g = hexdec(substr($hex, 2, 2));
        $b = hexdec(substr($hex, 4, 2));

        $luminance = (0.299 * $r + 0.587 * $g + 0.114 * $b) / 255;

        return $luminance > 0.5 ? '#242424' : '#f5f2f2';
    }

    private static function adjustBrightness($color, $percent)
    {
        list($r, $g, $b) = sscanf($color, "#%02x%02x%02x");
        $r = round(min(max($r + $percent, 0), 255));
        $g = round(min(max($g + $percent, 0), 255));
        $b = round(min(max($b + $percent, 0), 255));
        return sprintf("#%02x%02x%02x", $r, $g, $b);
    }
}

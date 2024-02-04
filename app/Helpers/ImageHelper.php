<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;

class ImageHelper
{
    public static function savePermanently(string $image, string $path): ?string
    {
        if (!Storage::disk('public')->exists($image)) {
            return null;
        }

        $newImagePath = str_replace('tmp/', $path . '/', $image);
        Storage::disk('public')->move($image, $newImagePath);

        return $newImagePath;
    }

    public static function getResizeDimensions(
        int $image_width,
        int $image_height,
        int $min_width,
        int $min_height,
        int $max_width,
        int $max_height
    ): array {
        [$check, $check_resize_to_width, $check_resize_to_height, $original_sizes_validated] = self::checkFileAspectRatio(
            $image_width,
            $image_height,
            $min_width,
            $min_height,
            $max_width,
            $max_height
        );

        if (!$check || (!$check_resize_to_height && !$check_resize_to_width)) {
            throw new \RuntimeException('Image dimensions are not valid.');
        }

        if ($original_sizes_validated) {
            return [$image_width, $image_height];
        }

        if ($check_resize_to_height) {
            [$resize_height_to_height, $resize_width_to_height] = self::getAspectRatio($image_height, $image_width, $min_height, $max_height);

            if (!$check_resize_to_width) {
                return [$resize_width_to_height, $resize_height_to_height];
            }
        }

        if ($check_resize_to_width) {
            [$resize_width_to_width, $resize_height_to_width] = self::getAspectRatio($image_width, $image_height, $min_width, $max_width);

            if (!$check_resize_to_height || abs((int)$resize_height_to_height - $image_height) > abs((int)$resize_height_to_width - $image_height)) {
                return [$resize_width_to_width, $resize_height_to_width];
            }
        }

        if (!isset($resize_width_to_height, $resize_height_to_height, $resize_width_to_width, $resize_height_to_width)) {
            throw new \RuntimeException('Error while resizing image.');
        }

        if (abs((int)$resize_height_to_height - $image_height) <= abs((int)$resize_height_to_width - $image_height)) {
            return [$resize_width_to_height, $resize_height_to_height];
        }

        return [$resize_width_to_width, $resize_height_to_width];
    }

    public static function checkFileAspectRatio(
        int $image_width,
        int $image_height,
        int $min_width,
        int $min_height,
        int $max_width,
        int $max_height
    ): array {
        $check_aspect_ration = self::checkAspectRatio($image_width, $image_height, $min_width, $min_height, $max_width, $max_height);

        if (!$check_aspect_ration) {
            $check_resize_to_width = ($image_width > $min_width && $image_width < $max_width) ||
                self::checkResizeAspectRatio($image_width, $image_height, $min_width, $max_width, $min_height, $max_height);
            $check_resize_to_height = ($image_height > $min_height && $image_height < $max_height) ||
                self::checkResizeAspectRatio($image_height, $image_width, $min_height, $max_height, $min_width, $max_width);

            return [
                $check_resize_to_width || $check_resize_to_height,
                $check_resize_to_width,
                $check_resize_to_height,
                false // original sizes are not validated
            ];
        }

        return [
            true,
            true,
            true,
            true // original sizes are not validated
        ];
    }

    public static function checkAspectRatio(
        int $image_width,
        int $image_height,
        int $min_width,
        int $min_height,
        int $max_width,
        int $max_height
    ): bool {
        return $image_width >= $min_width && $image_height >= $min_height && $image_width <= $max_width && $image_height <= $max_height;
    }

    public static function checkResizeAspectRatio(
        int $size1,
        int $size2,
        int $min_size1,
        int $max_size1,
        int $min_size2,
        int $max_size2
    ): bool {
        [$_, $resize2] = self::getAspectRatio($size1, $size2, $min_size1, $max_size1);
        return $resize2 >= $min_size2 && $resize2 <= $max_size2;
    }

    public static function getAspectRatio(
        int $size1,
        int $size2,
        int $min_size,
        int $max_size,
    ): array {
        $resize1 = ($size1 < $min_size || ($size1 < $max_size && ($size1 - $min_size) >= ($max_size - $size1)))
            ? $min_size
            : $max_size;
        return [$resize1, $size2 * ($resize1 / $size1)];
    }
}

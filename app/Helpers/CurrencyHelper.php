<?php

namespace App\Helpers;

use App\Models\Currency;

class CurrencyHelper
{
    public static function convertFloatToInt(float $value, Currency $currency): int
    {
        $multiplier = 10 ** $currency->precision;
        return (int)round($value * $multiplier);
    }

    public static function convertIntToFloat(int $value, Currency $currency): float
    {
        $divider = 10 ** $currency->precision;
        return $value / $divider;
    }

    public static function convertIntToFloatRounded(int $value, Currency $currency): float
    {
        $float = self::convertIntToFloat($value, $currency);
        return round($float, $currency->decimals);
    }

    public static function displayPrice(int $value, Currency $currency): string
    {
        $float = self::convertIntToFloatRounded($value, $currency);
        return $float . $currency->symbol;
    }

    public static function displayOnlyPrice(int $value, Currency $currency): string
    {
        $float = self::convertIntToFloatRounded($value, $currency);
        return $float;
    }

    public static function searchByIsoCode(string $iso_code): ?Currency
    {
        return Currency::where('iso_code', $iso_code)->first();
    }
}

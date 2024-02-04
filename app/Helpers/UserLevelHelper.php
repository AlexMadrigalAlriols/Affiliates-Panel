<?php

namespace App\Helpers;

use App\Models\Shop;
use App\Models\ShopLevel;
use App\Models\ShopLog;
use App\Models\User;
use App\Models\UserLevel;
use App\UseCases\UserLevels\StoreUseCase;

class UserLevelHelper
{
    public static function addExpToLevel(
        Shop $shop,
        User $user,
        float $import
    ): bool
    {
        if($import <= 0) {
            return true;
        }

        $user_level = self::findOrCreate($user, $shop);
        $expToAdd = $import * 100; // [TODO] Configurable setting.
        $expRequired = $user_level->shopLevel->level * 5000; // [TODO] Configurable setting.
        $newExp = $user_level->exp_progress + $expToAdd;

        while ($newExp >= $expRequired) {
            $new_level = self::findNextLevel($shop->id, $user_level->shopLevel->level);

            if ($new_level) {
                $user_level->shop_level_id = $new_level->id;
                $newExp -= $expRequired;
                $user_level->save();
                $user_level->refresh();

                $expRequired = $user_level->shopLevel->level * 5000;
            } else {
                // No hay más niveles, sal del bucle
                break;
            }
        }

        $user_level->exp_progress = $newExp;

        return $user_level->save();
    }

    public static function subtractExpAndLevel(
        Shop $shop,
        User $user,
        float $import
    ): bool {
        if ($import <= 0) {
            return true;
        }

        $user_level = self::findOrCreate($user, $shop);
        $expToSubtract = $import * 100; // [TODO] Configurable setting.

        // Restar experiencia
        $exp_progress = $user_level->exp_progress - $expToSubtract;

        while ($exp_progress < 0) {
            // Si la experiencia es negativa, restar un nivel y ajustar la experiencia
            $currentLevel = $user_level->shopLevel->level;

            if ($currentLevel > 1) {
                $user_level->shop_level_id = self::findPreviousLevel($shop->id, $currentLevel)->id;
                $exp_progress += $currentLevel * 5000;
                $user_level->save();
                $user_level->refresh();

                $currentLevel = $user_level->shopLevel->level;
            } else {
                $exp_progress = ($exp_progress < $currentLevel * 5000 && $exp_progress > 0) ? $exp_progress : 0;
                break;
            }
        }

        $user_level->exp_progress = $exp_progress;
        return $user_level->save();
    }

    public static function findOrCreate(User $user, Shop $shop): UserLevel
    {
        $level = self::find($user->id, $shop->id);

        if(!$level) {
            $level = (new StoreUseCase(
                $shop,
                $user
            ))->action();
        }

        return $level;
    }

    public static function find(int $user_id, int $shop_id): ?UserLevel
    {
        return UserLevel::where('user_id', $user_id)
            ->where('shop_id', $shop_id)
            ->first();
    }

    public static function findNextLevel(int $shop_id, int $actualLevel): ?ShopLevel
    {
        return ShopLevel::where('shop_id', $shop_id)
            ->where('level', $actualLevel + 1)
            ->first();
    }

    public static function findPreviousLevel(int $shop_id, int $actualLevel): ?ShopLevel
    {
        return ShopLevel::where('shop_id', $shop_id)
            ->where('level', $actualLevel - 1)
            ->first();
    }

    public static function getUserLevelOnShop(Shop $shop, User $user): int
    {
        $user_level = UserLevel::where('user_id', $user->id)
            ->where('shop_id', $shop->id)
            ->first();

        return $user_level ? $user_level->shopLevel->level : 0;
    }
}

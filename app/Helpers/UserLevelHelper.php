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

        if($shop->type === ShopLevel::TYPES['loop']) {
            $user_level->exp_progress += intval($import);

            if ($user_level->exp_progress > $shop->config['times_for_reward'] ?? 5) {
                $user_level->exp_progress = $user_level->exp_progress - ($shop->config['times_for_reward'] ?? 5);
                $user_level->data['times_collected'] = ($user_level->data['times_collected'] ?? 0) + 1;
            }

            return $user_level->save();
        }

        $shop_config = [
            'required_exp' => $shop->config['required_exp'] ?? config('levels.default_required_exp'),
            'point_multiplier' => $shop->config['point_multiplier'] ?? config('levels.default_point_multiplier'),
        ];

        $expToAdd = $import * $shop_config['point_multiplier'];
        $expRequired = $user_level->shopLevel->level * $shop_config['required_exp'];
        $newExp = $user_level->exp_progress + $expToAdd;

        while ($newExp >= $expRequired) {
            $new_level = self::findNextLevel($shop->id, $user_level->shopLevel->level);

            if ($new_level) {
                $user_level->shop_level_id = $new_level->id;
                $newExp -= $expRequired;
                $user_level->save();
                $user_level->refresh();

                $expRequired = $user_level->shopLevel->level * $shop_config['required_exp'];
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

        if($shop->type === ShopLevel::TYPES['loop']) {
            $user_level->exp_progress -= intval($import);

            if ($user_level->exp_progress < 0) {
                $user_level->exp_progress = 0;
            }

            return $user_level->save();
        }

        $shop_config = [
            'required_exp' => $shop->config['required_exp'] ?? config('levels.default_required_exp'),
            'point_multiplier' => $shop->config['point_multiplier'] ?? config('levels.default_point_multiplier'),
        ];
        $expToSubtract = $import * $shop_config['point_multiplier'];

        // Restar experiencia
        $exp_progress = $user_level->exp_progress - $expToSubtract;

        while ($exp_progress < 0) {
            $currentLevel = $user_level->shopLevel->level;

            if ($currentLevel > 1) {
                $user_level->shop_level_id = self::findPreviousLevel($shop->id, $currentLevel)->id;
                $exp_progress += $currentLevel * $shop_config['required_exp'];
                $user_level->save();
                $user_level->refresh();

                $currentLevel = $user_level->shopLevel->level;
            } else {
                $exp_progress = ($exp_progress < $currentLevel * $shop_config['required_exp'] && $exp_progress > 0) ? $exp_progress : 0;
                break;
            }
        }

        $user_level->exp_progress = $exp_progress;
        return $user_level->save();
    }

    public static function findOrCreate(User $user, Shop $shop): UserLevel
    {
        $level = self::find($user->id, $shop->id, $shop->type);

        if(!$level) {
            $level = (new StoreUseCase(
                $shop,
                $user,
                $shop->type
            ))->action();
        }

        return $level;
    }

    public static function find(int $user_id, int $shop_id, string $type): ?UserLevel
    {
        return UserLevel::where('user_id', $user_id)
            ->where('type', $type)
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
}

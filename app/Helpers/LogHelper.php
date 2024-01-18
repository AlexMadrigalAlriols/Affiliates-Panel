<?php

namespace App\Helpers;

use App\Models\Shop;
use App\Models\ShopLog;
use App\Models\User;

class LogHelper
{
    public static function generateLog(
        string $message,
        User $user,
        Shop $shop,
        string $type = 'no-type'
    ): bool
    {
        if(!in_array($type, ShopLog::TYPES)) {
            return false;
        }

        try {
            ShopLog::create([
                'type' => $type,
                'message' => $message,
                'user_id' => $user->id,
                'shop_id' => $shop->id
            ]);

            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
}

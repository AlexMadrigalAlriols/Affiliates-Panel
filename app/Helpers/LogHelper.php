<?php

namespace App\Helpers;

use App\Models\Log;
use App\Models\Shop;
use App\Models\ShopLog;
use App\Models\User;

class LogHelper
{
    public static function generateLog(
        string $message,
        ?User $user = null,
        ?Shop $shop = null,
        string $message_type = 'no-type',
        string $type = 'info',
    ): bool
    {
        if(!in_array($type, Log::TYPES)) {
            return false;
        }

        if(!in_array($message_type, Log::MESSAGE_TYPE)) {
            return false;
        }

        try {
            Log::create([
                'type' => $type,
                'message_type' => $message_type,
                'message' => $message,
                'user_id' => $user ? $user->id : null,
                'shop_id' => $shop ? $shop->id : null
            ]);

            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
}

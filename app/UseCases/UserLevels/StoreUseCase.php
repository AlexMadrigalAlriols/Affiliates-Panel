<?php

namespace App\UseCases\UserLevels;

use App\Models\Shop;
use App\Models\ShopLevel;
use App\Models\User;
use App\Models\UserLevel;
use App\UseCases\Core\UseCase;

class StoreUseCase extends UseCase
{
    public function __construct(
        protected Shop $shop,
        protected User $user,
        protected string $type = ShopLevel::TYPES['level'],
        protected int $default_exp = 0
    ) {
    }

    public function action(): UserLevel
    {
        $shop_level = null;
        if($this->type === ShopLevel::TYPES['level']) {
            $shop_level = ShopLevel::where('shop_id', $this->shop->id)->where('level', 1)->first();

            if(!$shop_level) {
                throw new \Exception('Shop Configuration Missing. No levels configured.');
            }
        }

        return UserLevel::create([
            'user_id' => $this->user->id,
            'shop_id'=> $this->shop->id,
            'exp_progress'=> $this->default_exp,
            'shop_level_id' => $shop_level ? $shop_level->id : null,
            'type' => $this->type,
        ]);
    }
}

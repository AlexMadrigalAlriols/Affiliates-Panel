<?php

namespace App\UseCases\ShopLevel;

use App\Models\Shop;
use App\Models\ShopLevel;
use App\UseCases\Core\UseCase;

class UpdateUseCase extends UseCase
{
    public function __construct(
        protected Shop $shop,
        protected string $type,
        protected array $data = [],
        protected array $rewards = []
    ) {
    }

    public function action(): Shop
    {
        if($this->type === ShopLevel::TYPES['level']) {
            $this->saveRewards();
        }

        if($this->type === ShopLevel::TYPES['loop']) {
            $this->shop->config = array_merge($this->shop->config, $this->data);
        }

        $this->shop->type = $this->type;
        $this->shop->save();

        return $this->shop;
    }

    private function saveRewards(): void
    {
        if($this->shop->type === ShopLevel::TYPES['level']) {
            $this->shop->shopLevels()->delete();
        }

        foreach ($this->rewards as $idx => $reward) {
            $this->shop->shopLevels()->create(
                [
                    'level' => $idx + 1,
                    'reward' => $reward
                ]
            );
        }
    }
}

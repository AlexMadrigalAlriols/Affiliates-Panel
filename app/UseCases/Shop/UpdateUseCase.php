<?php

namespace App\UseCases\Shop;

use App\Models\Shop;
use App\UseCases\Core\UseCase;

class UpdateUseCase extends UseCase
{
    public function __construct(
        protected Shop $shop,
        protected string $name,
        protected string $subdomain,
        protected string $description,
        protected ?string $file = null
    ) {
    }

    public function action(): Shop
    {
        $this->shop->name = $this->name;
        $this->shop->subdomain = $this->subdomain;
        $this->shop->description = $this->description;
        $this->shop->save();

        return $this->shop;
    }
}

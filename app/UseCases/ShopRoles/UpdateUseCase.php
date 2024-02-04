<?php

namespace App\UseCases\ShopRoles;

use App\Models\Shop;
use App\Models\ShopRole;
use App\Models\User;
use App\UseCases\Core\UseCase;

class UpdateUseCase extends UseCase
{
    public function __construct(
        protected ShopRole $shopRole,
        protected Shop $shop,
        protected User $user,
        protected string $role
    ) {
    }

    public function action(): ShopRole
    {
        $this->shopRole->user_id = $this->user->id;
        $this->shopRole->shop_id = $this->shop->id;
        $this->shopRole->role = $this->role;
        $this->shopRole->save();

        return $this->shopRole;
    }
}

<?php

namespace App\UseCases\ShopRoles;

use App\Models\Role;
use App\Models\Shop;
use App\Models\ShopRole;
use App\Models\User;
use App\UseCases\Core\UseCase;

class StoreUseCase extends UseCase
{
    public function __construct(
        protected Shop $shop,
        protected User $user,
        protected Role $role
    ) {
    }

    public function action(): ShopRole
    {
        return ShopRole::create([
            'user_id' => $this->user->id,
            'shop_id'=> $this->shop->id,
            'role_id' => $this->role->id
        ]);
    }
}

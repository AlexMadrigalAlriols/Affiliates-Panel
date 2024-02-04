<?php

namespace App\UseCases\Paychecks;

use App\Models\PayCheck;
use App\Models\Shop;
use App\Models\User;
use App\UseCases\Core\UseCase;
use Carbon\Carbon;

class StoreUseCase extends UseCase
{
    public function __construct(
        protected Shop $shop,
        protected User $user,
        protected int $import = 0,
        protected ?Carbon $expires_at = null
    ) {
    }

    public function action(): PayCheck
    {
        return PayCheck::create([
            'user_id' => $this->user->id,
            'shop_id'=> $this->shop->id,
            'expires_at'=> $this->expires_at,
            'import' => $this->import
        ]);
    }
}

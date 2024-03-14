<?php

namespace App\UseCases\Vouchers;

use App\Models\Shop;
use App\Models\User;
use App\Models\Voucher;
use App\UseCases\Core\UseCase;
use Carbon\Carbon;

class StoreUseCase extends UseCase
{
    public function __construct(
        protected Shop $shop,
        protected User $user,
        protected string $reward,
        protected ?Carbon $expires_at = null
    ) {
    }

    public function action(): Voucher
    {
        return Voucher::create([
            'code' => Voucher::generateCode(),
            'user_id' => $this->user->id,
            'shop_id'=> $this->shop->id,
            'expires_at'=> $this->expires_at,
            'reward' => $this->reward
        ]);
    }
}

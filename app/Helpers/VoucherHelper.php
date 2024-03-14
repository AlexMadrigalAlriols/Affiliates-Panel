<?php

namespace App\Helpers;

use App\Models\Shop;
use App\Models\User;
use App\Models\Voucher;
use App\UseCases\Vouchers\StoreUseCase;

class VoucherHelper
{
    public static function generateVoucher(
        Shop $shop,
        User $user,
        string $reward,
        ?\Carbon\Carbon $expires_at = null
    ): Voucher
    {
        return (new StoreUseCase($shop, $user, $reward, $expires_at))->action();
    }
}

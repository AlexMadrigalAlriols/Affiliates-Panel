<?php

namespace App\UseCases\Tickets;

use App\Models\Currency;
use App\Models\Shop;
use App\Models\Ticket;
use App\Models\User;
use App\UseCases\Core\UseCase;

class StoreUseCase extends UseCase
{
    public function __construct(
        protected Shop $shop,
        protected User $user,
        protected Currency $currency,
        protected int $import = 0
    ) {
    }

    public function action(): Ticket
    {
        return Ticket::create([
            'user_id' => $this->user->id,
            'shop_id'=> $this->shop->id,
            'currency_id'=> $this->currency->id,
            'import' => $this->import
        ]);
    }
}

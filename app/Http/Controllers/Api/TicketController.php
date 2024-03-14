<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Shop;
use App\Models\User;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    private $permissionTitle = 'ticket_';

    public function store(Request $request, Shop $shop)
    {
        if($redirect = $this->hasPermission($this->permissionTitle . 'create', $shop)) {
            return $redirect;
        }

        $user = User::findOrFail();
        $useCase = new StoreUseCase(
            $shop,
            $user,
            $shop->currency,
            CurrencyHelper::convertFloatToInt($request->input('import'), $shop->currency)
        );

        if($useCase->action()) {
            $success = UserLevelHelper::addExpToLevel(
                $shop,
                $user,
                $request->input('import')
            );

            $success ? toast('Ticked Created', 'success') : toast('Shop Configuration Missing', 'error');
        }

        return redirect()->route('dashboard.shop.panel.tickets', $shop->subdomain);
    }
}

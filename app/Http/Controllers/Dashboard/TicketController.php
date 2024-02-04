<?php

namespace App\Http\Controllers\Dashboard;

use App\Helpers\CurrencyHelper;
use App\Helpers\LogHelper;
use App\Helpers\UserLevelHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Tickets\StoreRequest;
use App\Models\Currency;
use App\Models\Shop;
use App\Models\Ticket;
use App\Models\User;
use App\UseCases\Tickets\StoreUseCase;

class TicketController extends Controller
{
    public function ticketsList(Shop $shop)
    {
        $tickets = $shop->shopTicketHistory()->withTrashed()->get();

        return view('dashboard.shop.panel.tickets.index', compact('shop', 'tickets'));
    }

    public function saveTicket(StoreRequest $request, Shop $shop, User $user)
    {
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

    public function returnTicket(Shop $shop, Ticket $ticket) {
        // [TODO] Rest the points equal import
        if ($shop->id === $ticket->shop->id && $ticket->delete()) {
            $success = UserLevelHelper::subtractExpAndLevel(
                $shop,
                $ticket->user,
                $ticket->import
            );

            $success ? toast('Configuration Saved', 'success') : toast('Shop Configuration Missing', 'error');

            LogHelper::generateLog(
                'Ticket was returned (Value: ' . $ticket->valueHuman . ')',
                auth()->user(),
                $shop,
                'delete'
            );
        } else {
            toast('Error returning ticket', 'error');
        }

        return redirect()->route('dashboard.shop.panel.tickets', $shop->subdomain);
    }
}

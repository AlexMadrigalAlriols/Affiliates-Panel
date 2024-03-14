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
use App\Traits\PermissionTrait;
use App\UseCases\Tickets\StoreUseCase;

class TicketController extends Controller
{
    use PermissionTrait;

    private $permissionTitle = 'ticket_';

    public function index(Shop $shop)
    {
        $permission = $this->permissionTitle;
        if($redirect = $this->hasPermission($permission . 'view', $shop)) {
            return $redirect;
        }

        $tickets = $shop->shopTicketHistory()->withTrashed()->get();

        return view('dashboard.shop.panel.tickets.index', compact('shop', 'tickets', 'permission'));
    }

    public function create(Shop $shop, User $user)
    {
        if($redirect = $this->hasPermission($this->permissionTitle . 'create', $shop)) {
            return $redirect;
        }

        return view('dashboard.shop.panel.tickets.create', compact('shop', 'user'));
    }

    public function store(StoreRequest $request, Shop $shop, User $user)
    {
        if($redirect = $this->hasPermission($this->permissionTitle . 'create', $shop)) {
            return $redirect;
        }

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
        if($redirect = $this->hasPermission($this->permissionTitle . 'delete', $shop)) {
            return $redirect;
        }

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

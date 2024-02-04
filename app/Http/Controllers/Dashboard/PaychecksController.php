<?php

namespace App\Http\Controllers\Dashboard;

use App\Helpers\CurrencyHelper;
use App\Helpers\LogHelper;
use App\Helpers\UserLevelHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Paychecks\StoreRequest;
use App\Models\Currency;
use App\Models\PayCheck;
use App\Models\Shop;
use App\Models\Ticket;
use App\Models\User;
use App\UseCases\Paychecks\StoreUseCase;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PaychecksController extends Controller
{
    public function list(Shop $shop)
    {
        $paychecks = $shop->shopPayChecks;

        return view('dashboard.shop.panel.paychecks.index', compact('shop', 'paychecks'));
    }

    public function create(Shop $shop, User $user) {
        return view('dashboard.shop.panel.paychecks.create', compact('shop', 'user'));
    }

    public function store(StoreRequest $request, Shop $shop, User $user) {
        $useCase = new StoreUseCase(
            $shop,
            $user,
            CurrencyHelper::convertFloatToInt($request->input('import'), $shop->currency),
            $request->input('expiration_date') ?
                Carbon::createFromFormat('Y-m-d', $request->input('expiration_date')) : null
        );

        LogHelper::generateLog(
            'Paycheck Add To (' . $user->email . ')',
            $request->user(),
            $shop,
            'create'
        );

        $useCase->action() ? toast('Paycheck created', 'success') : toast('An error ocurred', 'error');
        return redirect()->route('dashboard.shop.panel.paychecks', $shop->subdomain);
    }

    public function destroy(Request $request, Shop $shop, PayCheck $paycheck) {
        $paycheck->delete();

        LogHelper::generateLog(
            'Paycheck Removed To (' . $paycheck->user->email . ')',
            $request->user(),
            $shop,
            'create'
        );

        toast('Paycheck used', 'success');
        return redirect()->route('dashboard.shop.panel.paychecks', $shop->subdomain);
    }
}

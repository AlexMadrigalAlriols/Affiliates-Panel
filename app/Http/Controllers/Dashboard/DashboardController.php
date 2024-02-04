<?php
namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(): \Illuminate\Contracts\View\View
    {
        $user = Auth::user();
        $shops = $user->shops;
        $owned_shops = $user->owned_shops;

        return view('dashboard/main', compact('shops', 'owned_shops'));
    }

    public function paychecksIndex(): \Illuminate\Contracts\View\View
    {
        $user = Auth::user();
        $paychecks = $user->paychecks;

        return view('dashboard/paychecks', compact('paychecks'));
    }
}

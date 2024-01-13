<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class UserController extends Controller
{
    public function scanQr(Shop $shop) {
        $user = Auth::user();
        $user->shops->syncWithoutDetaching($shop->id);

        toast('Sucess Entered', 'success');

        return redirect()->route('dashboard.shop.show', $shop->subdomain);
    }
}

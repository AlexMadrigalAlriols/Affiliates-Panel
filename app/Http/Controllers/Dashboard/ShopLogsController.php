<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Log;
use App\Models\Shop;
use Illuminate\Http\Request;

class ShopLogsController extends Controller
{
    public function index(Request $request, Shop $shop) {
        $section = 'logs';

        if($request->ajax()) {
            $shopLogs = Log::where('shop_id', $shop->id)->orderBy('created_at', 'desc')->get();

            return view('partials.shopLogs.datatable', compact('shopLogs'));
        }

        return view('dashboard.shop.panel.configurations.logs', compact('shop', 'section'));;
    }
}

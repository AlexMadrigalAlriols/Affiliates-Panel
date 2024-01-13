<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Shop;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class ShopController extends Controller
{
    public function show(Shop $shop)
    {
        return view('dashboard.shop.show', compact('shop'));
    }

    public function overview(Shop $shop)
    {
        return view('dashboard.shop.panel.main', compact('shop'));
    }

    public function memberList(Shop $shop)
    {
        return view('dashboard.shop.panel.members', compact('shop'));
    }

    public function shopConfig(Shop $shop)
    {
        return view('dashboard.shop.panel.configuration', compact('shop'));
    }


    public function generateShopQr(Shop $shop) {
        $url = url($shop->subdomain);

        $qr = QrCode::size(50)->generate($url);
        try {
            return response($qr)->header('Content-Type', 'image/svg+xml');
        } catch (\Exception $e) {
            return response($e->getMessage(), 500); // Devuelve un mensaje de error en lugar del QR
        }
    }
}

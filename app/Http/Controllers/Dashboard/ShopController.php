<?php

namespace App\Http\Controllers\Dashboard;

use App\Helpers\LogHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Shop\UpdateRequest;
use App\Models\Shop;
use App\Models\ShopRole;
use App\UseCases\Shop\UpdateUseCase;
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

    public function customerList(Shop $shop)
    {
        return view('dashboard.shop.panel.customers', compact('shop'));
    }

    public function shopConfig(Shop $shop)
    {
        $roles = ShopRole::ROLES;

        return view('dashboard.shop.panel.configuration', compact('shop', 'roles'));
    }

    public function ticketsList(Shop $shop)
    {
        return view('dashboard.shop.panel.tickets', compact('shop'));
    }

    public function generateShopQr(Shop $shop) {
        $url = url($shop->subdomain);

        $qr = QrCode::size(500)->generate($url);
        try {
            return response($qr)->header('Content-Type', 'image/svg+xml');
        } catch (\Exception $e) {
            return response($e->getMessage(), 500); // Devuelve un mensaje de error en lugar del QR
        }
    }

    public function update(UpdateRequest $request, Shop $shop) {
        $useCase = new UpdateUseCase(
            $shop,
            $request->input('name'),
            $request->input('subdomain'),
            $request->input('description') ?? ''
        );
        $useCase->action();

        LogHelper::generateLog(
            'Shop Configuration Modified',
            $request->user(),
            $shop,
            'edit'
        );

        toast('Configuration Saved', 'success');

        return redirect()->route('dashboard.shop.panel.configuration', $shop->subdomain);
    }
}

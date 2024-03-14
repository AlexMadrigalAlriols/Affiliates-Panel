<?php

namespace App\Http\Controllers\Dashboard;

use App\Helpers\ColorHelper;
use App\Helpers\LogHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Shop\UpdateDataRequest;
use App\Http\Requests\Shop\UpdateRequest;
use App\Models\Currency;
use App\Models\Shop;
use App\Traits\PermissionTrait;
use App\UseCases\Shop\UpdateUseCase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class ShopController extends Controller
{
    use PermissionTrait;

    private $permissionTitle = 'configuration_';

    public function show(Shop $shop)
    {
        $user = auth()->user();

        return view('dashboard.shop.show', compact('shop', 'user'));
    }

    public function overview(Shop $shop)
    {
        return view('dashboard.shop.panel.main', compact('shop'));
    }

    public function customerList(Shop $shop)
    {
        if ($redirect = $this->hasPermission('client_view', $shop)) {
            return $redirect;
        }

        return view('dashboard.shop.panel.customers.index', compact('shop'));
    }

    public function shopConfig(Shop $shop)
    {
        if ($redirect = $this->hasPermission($this->permissionTitle . 'view', $shop)) {
            return $redirect;
        }

        $section = 'general';
        $currencies = Currency::all();

        return view('dashboard.shop.panel.configurations.general', compact('shop', 'currencies', 'section'));
    }

    public function shopAppearance(Shop $shop)
    {
        if ($redirect = $this->hasPermission($this->permissionTitle . 'view', $shop)) {
            return $redirect;
        }

        $section = 'appearance';
        $currencies = Currency::all();

        $colors = ColorHelper::generateColors('#FEDE00', '#e0d3d3');

        return view('dashboard.shop.panel.configurations.appearance', compact('shop', 'currencies', 'section'));
    }

    public function generateShopQr(Shop $shop)
    {
        $url = route('dashboard.user.scan.qr', ['shop' => $shop->subdomain, 'user' => auth()->user()->id]);

        $qr = QrCode::size(500)->generate($url);
        try {
            return response($qr)->header('Content-Type', 'image/svg+xml');
        } catch (\Exception $e) {
            return response($e->getMessage(), 500);
        }
    }

    public function generateColours(Shop $shop, Request $request)
    {
        $colors = ColorHelper::generateColors(
            $request->input('primary'),
            $request->input('secondary')
        );

        return response()->json($colors);
    }

    public function update(UpdateRequest $request, Shop $shop)
    {
        if ($redirect = $this->hasPermission($this->permissionTitle . 'edit', $shop)) {
            return $redirect;
        }

        // Verifica si hay un archivo temporal almacenado en la sesión
        if ($request->session()->has('dropzone_temp_path')) {
            $tempPath = $request->session()->get('dropzone_temp_path');
            $fileName = pathinfo($tempPath, PATHINFO_FILENAME) . '_' . uniqid() . '.' . pathinfo($tempPath, PATHINFO_EXTENSION);

            $storaged = Storage::disk('public')->put('shop_banners/' . $fileName, Storage::disk('local')->get($tempPath));

            Storage::disk('local')->delete($tempPath);
            $request->session()->forget('dropzone_temp_path');
            $permanentPath = 'storage/shop_banners/' . $fileName;

            if(isset($shop->config['banner_img']) && $storaged) {
                Storage::disk('public')->delete($shop->config['banner_img']);
            }
        }

        $useCase = new UpdateUseCase(
            $shop,
            $request->input('name'),
            $request->input('subdomain'),
            Currency::findOrFail($request->input('currency_id')),
            $request->input('description') ?? '',
            [],
            $permanentPath ?? null
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

    public function updateData(UpdateDataRequest $request, Shop $shop)
    {
        if ($redirect = $this->hasPermission($this->permissionTitle . 'edit', $shop)) {
            return $redirect;
        }

        $data = ["colors" => $request->input('colors')];

        // Verifica si hay un archivo temporal almacenado en la sesión
        if ($request->session()->has('dropzone_temp_path')) {
            $tempPath = $request->session()->get('dropzone_temp_path');
            $fileName = pathinfo($tempPath, PATHINFO_FILENAME) . '_' . uniqid() . '.' . pathinfo($tempPath, PATHINFO_EXTENSION);

            Storage::disk('public')->put('shop_logos/' . $fileName, Storage::disk('local')->get($tempPath));

            Storage::disk('local')->delete($tempPath);
            $request->session()->forget('dropzone_temp_path');
            $data['shop_logo'] = 'storage/shop_logos/' . $fileName;
        }

        $useCase = new UpdateUseCase(
            $shop,
            $shop->name,
            $shop->subdomain,
            $shop->currency,
            $shop->description,
            $data
        );
        $useCase->action();

        LogHelper::generateLog(
            'Shop Configuration Modified',
            $request->user(),
            $shop,
            'edit'
        );

        toast('Configuration Saved', 'success');

        return redirect()->route('dashboard.shop.panel.configuration.appearance.index', $shop->subdomain);
    }
}

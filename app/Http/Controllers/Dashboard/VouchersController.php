<?php

namespace App\Http\Controllers\Dashboard;

use App\Helpers\CurrencyHelper;
use App\Helpers\LogHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Vouchers\StoreRequest;
use App\Models\Shop;
use App\Models\User;
use App\Models\Voucher;
use App\Traits\PermissionTrait;
use App\UseCases\Vouchers\StoreUseCase;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class VouchersController extends Controller
{
    use PermissionTrait;

    private $permissionTitle = 'voucher_';

    public function index(): \Illuminate\Contracts\View\View
    {
        $user = Auth::user();
        $vouchers = $user->vouchers;
        $expired_vouchers = $user->vouchers()->withoutGlobalScope('notExpired')->whereDate('expires_at', '<', now())->get();
        $used_vouchers = $user->vouchers()->withoutGlobalScope('notExpired')->withTrashed()->whereNotNull('deleted_at')->get();

        return view('dashboard/wallet/index', compact('vouchers', 'expired_vouchers', 'used_vouchers', 'user'));
    }

    public function generateShopQr(Shop $shop, Voucher $voucher) {
        $url = route('dashboard.shop.panel.voucher.use', ['shop' => $shop->subdomain, 'voucher' => $voucher->code]);

        $qr = QrCode::size(500)->generate($url);
        try {
            return response($qr)->header('Content-Type', 'image/svg+xml');
        } catch (\Exception $e) {
            return response($e->getMessage(), 500); // Devuelve un mensaje de error en lugar del QR
        }
    }

    public function show(Voucher $voucher): \Illuminate\Contracts\View\View
    {
        $user = Auth::user();
        return view('dashboard/wallet/show', compact('voucher', 'user'));
    }

    public function list(Shop $shop)
    {
        if($redirect = $this->hasPermission($this->permissionTitle . 'view', $shop)) {
            return $redirect;
        }

        $vouchers = $shop->shopPayChecks()->withoutGlobalScope('notExpired')->get();
        $permission = $this->permissionTitle;

        return view('dashboard.shop.panel.vouchers.index', compact('shop', 'vouchers', 'permission'));
    }

    public function create(Shop $shop, User $user) {
        if($redirect = $this->hasPermission($this->permissionTitle . 'create', $shop)) {
            return $redirect;
        }

        return view('dashboard.shop.panel.vouchers.create', compact('shop', 'user'));
    }

    public function store(StoreRequest $request, Shop $shop, User $user) {
        if($redirect = $this->hasPermission($this->permissionTitle . 'create', $shop)) {
            return $redirect;
        }

        $useCase = new StoreUseCase(
            $shop,
            $user,
            $request->input('reward'),
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
        return redirect()->route('dashboard.shop.panel.vouchers', $shop->subdomain);
    }

    public function use(Request $request, Shop $shop, Voucher $voucher) {
        if($redirect = $this->hasPermission($this->permissionTitle . 'delete', $shop)) {
            return $redirect;
        }

        $voucher->delete();

        LogHelper::generateLog(
            'Voucher Used To (' . $voucher->user->email . ')',
            $request->user(),
            $shop,
            'delete'
        );

        toast('Voucher used', 'success');
        return redirect()->route('dashboard.shop.panel.paychecks', $shop->subdomain);
    }
}

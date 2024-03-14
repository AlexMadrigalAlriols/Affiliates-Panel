<?php

namespace App\Http\Controllers\Dashboard;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\UploadRequest;
use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(): \Illuminate\Contracts\View\View
    {
        $user = Auth::user();
        $shops = $user->shops()->whereDoesntHave('shopRoles', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->get();
        $owned_shops = $user->owned_shops;

        return view('dashboard/main', compact('shops', 'owned_shops', 'user'));
    }

    public function exploreIndex(): \Illuminate\Contracts\View\View
    {
        $user = Auth::user();

        return view('dashboard/search', compact('user'));
    }

    public function searchShop(Request $request)
    {
        $shop = Shop::where('subdomain', $request->input('search_input'))->first();

        if($shop) {
            return redirect()->route('dashboard.user.scan.shop.qr', ['shop' => $shop->subdomain]);
        }

        toast('Shop not found', 'error');
        return back();
    }

    public function settingsIndex(string $section) {
        $user = Auth::user();

        return view('dashboard.settings.main', compact('section', 'user'));
    }

    public function settings(): \Illuminate\Contracts\View\View
    {
        $user = Auth::user();
        $settings = [
            [
                'title' => 'General',
                'icon' => 'bx bx-cog',
                'url' => route('dashboard.settings.main.index', 'general')
            ],
            [
                'title' => 'Security',
                'icon' => 'bx bx-lock',
                'url' => '#'
            ],
            [
                'title' => 'Notifications',
                'icon' => 'bx bx-bell',
                'url' => '#'
            ],
            [
                'title' => 'Support',
                'icon' => 'bx bx-info-circle',
                'url' => '#'
            ],
            [
                'title' => 'FAQ',
                'icon' => 'bx bx-conversation',
                'url' => '#'
            ],
            [
                'title' => 'Logout',
                'icon' => 'bx bx-log-out text-danger',
                'url' => route('logout')
            ]
        ];

        return view('dashboard/settings/index', compact('user', 'settings'));
    }

    public function uploadFile(UploadRequest $request)
    {
        // Verifica si se ha cargado un archivo
        if ($request->hasFile('dropzone_image')) {
            $file = $request->file('dropzone_image');

            $tempPath = $file->store('temp');
            $request->session()->put('dropzone_temp_path', $tempPath);

            return response()->json(['path' => $tempPath], 200);
        }

        return response()->json(['error' => 'No file uploaded.'], 400);
    }
}

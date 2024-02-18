<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Shop;
use App\UseCases\Users\GetQueryBuilderUseCase;
use Illuminate\Database\Eloquent\Builder;
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

    public function unmarkShop(Shop $shop) {
        $user = Auth::user();
        $user->shops()->detach($shop->id);

        toast('Sucess Entered', 'success');

        return redirect()->route('dashboard.main');
    }

    public function select2(Request $request, Shop $shop): \Illuminate\Http\JsonResponse
    {
        $query = (new GetQueryBuilderUseCase($request->input('search')))->action();

        $paginatedData = $query->whereHas('shops', function(Builder $query) use ($shop) {
            $query->where('shop_id', $shop->id);
        })->paginate(15);

        $data = $paginatedData->map(function ($item) {
            return [
                'id' => $item->id,
                'text' => $item->full_name . ' (' . $item->email . ')'
            ];
        })->sortBy('text')->toArray();

        $results = [
            'results' => $data,
            'pagination' => [
                'more' => $paginatedData->hasMorePages()
            ]
        ];

        return response()->json($results);
    }
}

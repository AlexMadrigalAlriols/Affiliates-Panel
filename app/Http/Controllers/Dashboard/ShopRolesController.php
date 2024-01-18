<?php

namespace App\Http\Controllers\Dashboard;

use App\Helpers\ApiResponse;
use App\Helpers\LogHelper;
use App\Http\Controllers\Controller;
use App\Models\Shop;
use App\Models\ShopRole;
use Illuminate\Http\Request;

class ShopRolesController extends Controller
{
    public function update(Request $request, $id)
    {
        // $useCase = new UpdateUseCase(
        //     $shop,
        //     $request->input('name'),
        //     $request->input('subdomain'),
        //     $request->input('description') ?? ''
        // );
        // $useCase->action();

        toast('Configuration Saved', 'success');

        return ApiResponse::ok([]);
    }

    public function index(Request $request, Shop $shop) {
        if($request->ajax()) {
            $shopRoles = ShopRole::where('shop_id', $shop->id)->get();

            return view('partials.shopRoles.datatable', compact('shopRoles'));
        }

        return [];
    }

    public function destroy(Request $request, ShopRole $shopRole)
    {
        if (
            !in_array($shopRole->shop_id, $request->user()->owned_shops->pluck('id')->toArray())
            || $shopRole->user_id === $request->user()->id
        ) {
            return ApiResponse::fail(__('Error on Request'));
        }

        if (!$shopRole->delete()) {
            return ApiResponse::fail(__('Error on deleting Role'));
        }

        LogHelper::generateLog(
            'Member Role Deleted (' . $shopRole->user->email . ')',
            $request->user(),
            $shopRole->shop,
            'delete'
        );

        return ApiResponse::done('Success Role Deleted');
    }
}

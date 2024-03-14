<?php

namespace App\Http\Controllers\Dashboard;

use App\Helpers\ApiResponse;
use App\Helpers\LogHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Roles\StoreRequest;
use App\Http\Requests\Roles\UpdateRequest;
use App\Models\Role;
use App\Models\Shop;
use App\Models\ShopRole;
use App\Models\User;
use App\UseCases\ShopRoles\StoreUseCase;
use App\UseCases\ShopRoles\UpdateUseCase;
use Illuminate\Http\Request;

class ShopRolesController extends Controller
{
    public function update(UpdateRequest $request, Shop $shop, ShopRole $shopRole)
    {
        $user = User::findOrFail($request->input('user_id'));
        $role = Role::findOrFail($request->input('role_id'));

        $useCase = new UpdateUseCase(
            $shopRole,
            $shop,
            $user,
            $role
        );
        $useCase->action();

        LogHelper::generateLog(
            'Role Modified (' . $user->email . ') (' . $role->title . ')',
            $request->user(),
            $shop,
            'update'
        );

        return ApiResponse::done('Success saved role.');
    }

    public function index(Request $request, Shop $shop) {
        $section = 'roles';
        $roles = Role::where('title', '!=', 'Owner')->where('type', Role::TYPES['shop'])->get();

        if($request->ajax()) {
            $shopRoles = ShopRole::where('shop_id', $shop->id)->get();

            return view('partials.shopRoles.datatable', compact('shopRoles'));
        }

        return view('dashboard.shop.panel.configurations.members', compact('shop', 'roles', 'section'));
    }

    public function create(Request $request, Shop $shop) {
        $users = $shop->shopCustomers;
        $roles = Role::where('title', '!=', 'Owner')->where('type', Role::TYPES['shop'])->get();
        $shopRole = new ShopRole();

        $viewData = compact('shopRole', 'users', 'roles');

        if ($request->ajax()) {
            return view('partials.shopRoles.modal_form', $viewData);
        }
    }

    public function edit(Request $request, Shop $shop, ShopRole $shopRole) {
        $users = $shop->shopCustomers;
        $roles = Role::where('title', '!=', 'Owner')->where('type', Role::TYPES['shop'])->get();

        $viewData = compact('shopRole', 'users', 'roles');

        if ($request->ajax()) {
            return view('partials.shopRoles.modal_form', $viewData);
        }
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

    public function store(StoreRequest $request, Shop $shop) {
        $user = User::findOrFail($request->input('user_id'));
        $role = Role::findOrFail($request->input('role_id'));

        $useCase = new StoreUseCase(
            $shop,
            $user,
            $role
        );
        $useCase->action();

        LogHelper::generateLog(
            'Member Role Add (' . $user->email . ') (' . $role->title . ')',
            $request->user(),
            $shop,
            'create'
        );

        return ApiResponse::done('Success add member to roles');
    }
}

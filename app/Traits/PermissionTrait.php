<?php

namespace App\Traits;

use App\Models\Shop;
use App\Models\User;

trait PermissionTrait
{
    public function hasPermission(string $permissionTitle, Shop $shop)
    {
        $exists = auth()->user()->shopRoles()->whereHas('role', function ($query) use ($permissionTitle) {
            $query->whereHas('permissions', function($query) use ($permissionTitle) {
                $query->where('title', $permissionTitle);
            });
        })->whereHas('shop', function ($query) use ($shop) {
            $query->where('id', $shop->id);
        })->exists();

        if(!$exists) {
            toast('You have permission to perform this action.', 'error');
            return redirect()->route('dashboard.shop.panel.overview', $shop->subdomain);
        }

        return false;
    }
}

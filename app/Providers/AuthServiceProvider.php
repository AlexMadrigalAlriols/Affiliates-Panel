<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        Gate::define('hasPermissionInShop', function ($user, $permissionTitle, $shopId) {
            if($user->is_admin) {
                return true;
            }

            return $user->shopRoles()->whereHas('role', function ($query) use ($permissionTitle) {
                $query->whereHas('permissions', function($query) use ($permissionTitle) {
                    $query->where('title', $permissionTitle);
                });
            })->whereHas('shop', function ($query) use ($shopId) {
                $query->where('id', $shopId);
            })->exists();
        });
    }
}

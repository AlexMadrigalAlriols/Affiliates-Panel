<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckOwnedShop
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        if (!$user->is_admin && !$user->owned_shops()->where(
            'subdomain', is_string($request->route('shop'))
                ? $request->route('shop') : $request->route('shop')->subdomain)->exists()
        ) {
            return redirect()->route('dashboard.main');
        }

        return $next($request);
    }
}

<?php

namespace App\Http\Middleware;

use App\Models\Shop;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApiAuth
{
    public function handle($request, Closure $next)
    {
        // Verificar si el API key está presente en la solicitud
        if (!$request->hasHeader('X-API-Key')) {
            return response()->json(['error' => 'API key missing'], 401);
        }

        // Obtener el API key de la solicitud
        $apiKey = $request->header('X-API-Key');

        // Buscar la tienda correspondiente al API key
        $shop = Shop::where('config->api_key', $apiKey)->first();

        // Verificar si la tienda existe
        if (!$shop) {
            return response()->json(['error' => 'Invalid API key'], 401);
        }

        // Agregar la tienda al request para que esté disponible en los controladores
        $request->attributes->add(['shop' => $shop]);

        return $next($request);
    }
}

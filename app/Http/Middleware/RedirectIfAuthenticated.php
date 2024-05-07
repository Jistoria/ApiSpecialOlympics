<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next, $guard)
    {
        if ($token = $request->cookie('cookie_token')) {
            $request->headers->set('Authorization', 'Bearer ' . $token);
        }

            // Si hay un token de autenticación en la solicitud, intenta autenticar al usuario utilizando ese token
            if (Auth::guard($guard)->check()) {
                return response()->json(['success'=>false, 'message'=>'Hay Sesión'],403);
            }
        // Si el usuario no está autenticado, permite que la solicitud continúe sin cambios
        return $next($request);
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsAdmin
{
    /**
     * Maneja una petición entrante.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Validamos directamente por el email del administrador que tenés cargado en la base de datos
        if (auth()->check() && auth()->user()->email === 'admin@books.com') {
            
            // Si es el email del admin, le damos luz verde
            return $next($request);
        }

        // Si es cualquier otro usuario, lo rebotamos al listado público
        return redirect()
            ->route('blog.index')
            ->with('status', 'Acceso denegado. Se requieren permisos de administrador.');
    }
}
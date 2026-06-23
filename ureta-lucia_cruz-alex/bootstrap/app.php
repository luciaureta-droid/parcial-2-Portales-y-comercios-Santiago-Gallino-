<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Session;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        
        // 1. Lógica del Profe: Redirección para visitas que intenten entrar a rutas con auth
        $middleware->redirectGuestsTo(function() {
            Session::flash('feedback.message', 'Para acceder a esta sección es necesario iniciar sesión.');
            Session::flash('feedback.type', 'danger');
            return route('login.show');
        });

        // 2. Registro de Alias (¡Acá mapeamos el 'admin' con la ruta real del archivo!)
        $middleware->alias([
            'admin' => \App\Http\Middleware\EnsureUserIsAdmin::class,
        ]);
        
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
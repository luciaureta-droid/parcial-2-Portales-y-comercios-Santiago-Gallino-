<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Muestra el formulario de inicio de sesión.
     */
    public function show()
    {
        return view('auth.login');
    }

    /**
     * Procesa el intento de autenticación de las credenciales.
     */
    public function process(Request $request)
    {
        // 1. Capturamos los datos que sirven como credenciales
        $credentials = $request->only(['email', 'password']);

        // 2. Intentamos autenticar con la Façade Auth. Si da false, regresamos con error
        if (Auth::attempt($credentials) === false) {
            return redirect()
                ->route('login.show')
                ->withInput()
                ->with('feedback.message', 'Las credenciales ingresadas no coinciden con nuestros registros.')
                ->with('feedback.type', 'danger');
        }

        // 3. El usuario está autenticado correctamente.
        // Aplicamos la redirección inteligente según el rol/email:
        
        if (Auth::user()->email === 'admin@books.com') {
            // Si es el Administrador oficial del examen, va directo al ABM de libros
            return redirect()
                ->route('books.admin')
                ->with('feedback.message', '¡Hola de nuevo, ' . Auth::user()->email . '!');
        }

        // Si es Juan o cualquier cliente común, va mandatoriamente al catálogo público para poder reservar
        return redirect()
            ->route('books.index')
            ->with('feedback.message', '¡Hola de nuevo, ' . Auth::user()->name . '!');
    }

    /**
     * Cierra la sesión activa de forma segura.
     */
    public function logout(Request $request)
    {
        // Cerramos sesión en el sistema de autenticación de Laravel
        Auth::logout();

        // Invalidamos y regeneramos tokens de sesión por seguridad (Evita session fixation)
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()
            ->route('login.show')
            ->with('feedback.message', 'Sesión terminada con éxito. ¡Te esperamos de nuevo pronto!');
    }
}
<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function show()
    {
        return view('auth.login');
    }

    public function process(Request $request)
    {
        // 1. Validamos los datos ingresados en el formulario
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // 2. Intentamos iniciar sesión
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            
            // 3.  Ahora te manda directo al panel administrativo (ABM)
            return redirect()->route('blog.index');
        }

        // Si falla, vuelve atrás mostrando el error
        return back()->withErrors([
            'email' => 'Las credenciales no coinciden con los registros de datos.txt.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login.show');
    }
}
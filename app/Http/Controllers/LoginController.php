<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('login'); // Carga la vista del login
    }

    public function login(Request $request)
    {
        // Validar los datos de entrada
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        // Intentar autenticar al usuario
        if (Auth::attempt($credentials)) {
            // Guardar el ID del usuario en la sesión
            $request->session()->put('user_id', Auth::id());

            return redirect()->route('dashboard'); // Redirige a la vista principal
        }

        return back()->withErrors(['email' => 'Las credenciales no coinciden con nuestros registros.']);
    }

    public function logout(Request $request)
    {
        // Cerrar sesión
        Auth::logout();
        $request->session()->forget('user_id');
        return redirect()->route('login');
    }
}

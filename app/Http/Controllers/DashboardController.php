<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // Asegúrate de que esté importado

class DashboardController extends Controller
{
    public function showDashboard(Request $request)
    {
        // Obtener el ID del usuario desde la sesión
        $userId = $request->session()->get('user_id');

        if (!$userId) {
            return redirect()->route('login')->with('error', 'Por favor, inicia sesión.');
        }

        // Obtener los datos del usuario
        $user = User::find($userId);

        if (!$user) {
            return redirect()->route('login')->with('error', 'Usuario no encontrado.');
        }

        // Pasar el usuario a la vista
        return view('dashboard', ['user' => $user]);
    }
}

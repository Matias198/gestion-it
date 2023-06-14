<?php

namespace App\Http\Controllers;

use Illuminate\Console\View\Components\Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        return view('login.index');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
 
        if (Auth::attempt($credentials)) {
            // El usuario ha iniciado sesión correctamente
            return redirect()->intended('/users'); // Redirigir a la página de inicio después del inicio de sesión exitoso
        }

        // Las credenciales de inicio de sesión son inválidas
        return redirect()->back()->withErrors([
            'email' => 'Las credenciales proporcionadas son incorrectas',
        ]);
    }
}

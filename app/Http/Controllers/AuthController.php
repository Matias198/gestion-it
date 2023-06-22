<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        if (session('user')) {
            return redirect()->route('layouts.welcome');
        }
        return view('login.index');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // El usuario ha iniciado sesión correctamente
            $user = Auth::user();
            // Elimina si hay un usuario ya logeado
            session(['user' => ""]);
            // Guardar los datos del usuario en la variable de sesión
            session(['user' => $user]);

            return redirect()->intended('/'); // Redirigir a la página de inicio después del inicio de sesión exitoso
        }

        // Las credenciales de inicio de sesión son inválidas
        return redirect()->back()->withErrors([
            'email' => 'Las credenciales proporcionadas son incorrectas',
        ]);
    }

    public function showRegistrationForm()
    {
        return view('login.register');
    }

    public function register(Request $request)
    {
        // Validar los datos enviados por el formulario de registro
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8', 
        ]);

        // Crear el nuevo usuario
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email; 
        $user->password = bcrypt($request->password);

        // Buscar el rol "cliente" en la base de datos
        $clienteRole = Role::where('name', 'Usuario Comun')->first();

        // Asignar el rol al nuevo usuario
        $user->role_id = $clienteRole->id;
        
        // Guardar el usuario en la base de datos
        $user->save();
        
        // Guardar los datos del usuario en la variable de sesión
        session(['user' => $user]);

        // Iniciar sesión automáticamente después del registro
        Auth::login($user);

        // Redirigir al usuario a la página de inicio o a donde desees después del registro exitoso
        return redirect()->route('layouts.welcome');
    }

    public function logout()
    {
        Auth::logout(); // Cerrar sesión del usuario
        // Guardar los datos del usuario en la variable de sesión
        session(['user' => ""]);

        // Redirigir al inicio o a la página que desees después del logout
        return redirect()->route('auth.login');
    }
}

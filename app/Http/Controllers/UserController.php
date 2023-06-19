<?php

namespace App\Http\Controllers;
  
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert as FacadesAlert;

class UserController extends Controller
{
    public function index()
    {
        // Obtener todos los usuarios
        $users = User::with('role')->get();
        $roles = Role::all(); 
        return view('users.index', ['roles' => $roles, 'users' => $users]);
    }

    public function create()
    {
        // Mostrar formulario de creación de usuario
        $roles = Role::all();
        return view('users.create', ['roles' => $roles]);
    }

    public function store(Request $request)
    {
        // Validar los datos enviados por el formulario
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'role' => 'required|exists:roles,id' // Asegurarse de validar el role_id
        ]); 
         
        // Crear una nueva instancia de User
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role_id = $request->input('role_id');
        $user->password = bcrypt($request->password);
        $user->save();
        return redirect()->route('users.index')->with('success', 'Usuario creado correctamente.');
    }


    public function edit(User $user)
    {
        // Mostrar formulario de edición de usuario
        $roles = Role::all();
        return view('users.edit', ['roles' => $roles, 'user'=> $user, compact('user')]);
    }

    public function update(Request $request, User $user)
    {
        // Validar los datos enviados por el formulario
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'password' => 'nullable|min:8',
            'role_id' => 'required|integer',
            'role' => 'required|exists:roles,id' // Asegurarse de validar el role_id
        ]); 

        // Actualizar los datos del usuario
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role_id = $request->input('role_id');
        if($request->password){
            $user->password = bcrypt($request->password);
        }
        $user->save();

        return redirect()->route('users.index')->with('success', 'Usuario actualizado correctamente.');
    }

    public function destroy(User $user)
    {
        // Eliminar el usuario 
        $user->delete();
        return redirect()->route('users.index')->with('success', 'Usuario eliminado correctamente.');
    }
}

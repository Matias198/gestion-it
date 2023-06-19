<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::all(); // Obtener todos los roles desde la base de datos
        return view('roles.index', ['roles' => $roles]); // Retornar una vista con los roles
    }

    public function create()
    {
        return view('roles.create');
    }

    public function store(Request $request)
    {
        // Obtén los permisos seleccionados del campo oculto
        $permissions = $request->input('permissions');
        // convierte los permissions en un json de elementos separados por comas
        $perms = explode(',', $permissions);
        // Elimina el último elemento del array (una coma)
        array_pop($perms);
        $permissions = json_encode($perms);


        // Guarda el rol en la base de datos junto con los permisos
        $role = Role::create([
            'name' => $request->input('name'),
            'permisos' => $permissions,
        ]);
        $role->save();

        // Redirige a la página deseada después de crear el rol
        return redirect()->route('roles.index');
    }

    public function edit($id)
    {
        $rol = Role::findOrFail($id);

        // Decodificar el campo de permisos JSON en un objeto o matriz de PHP
        $permisos = json_decode($rol->permisos);
        // Transformar permisos a un array de permisos
        $permisos = (array) $permisos;

        return view('roles.editar', compact('rol', 'permisos'));
    }

    public function update(Request $request, $id)
    {
        $role = Role::findOrFail($id);

        // Validar los datos enviados en el formulario
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'permissions' => '',
        ]);

        // Convertir los permisos en un array de permisos
        $permisos = explode(',', $validatedData['permissions']); 

        // Convertir el array de permisos en un JSON
        $permissions = json_encode($permisos);

        // Actualizar los campos del rol
        $role->name = $validatedData['name'];
        $role->permisos = $permissions;
        $role->save();

        // Redirigir a una página de éxito o mostrar un mensaje de éxito
        return redirect()->route('roles.index');
    }


    public function destroy($id)
    { {
            $rule = Role::findOrFail($id);
            $rule->delete();
            return redirect()->route('roles.index');
        }
    }
}

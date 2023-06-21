<?php

namespace App\Http\Controllers;

use App\Models\Permisos;
use Illuminate\Http\Request;
use App\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::all(); // Obtener todos los roles desde la base de datos
        $permisos = Permisos::all(); // Obtener todos los permisos desde la base de datos
        return view('roles.index', compact('roles', 'permisos')); // Pasar los roles y permisos a la vista
    }

    public function create()
    {
        $permisos = Permisos::all(); // Obtener todos los permisos desde la base de datos
        return view('roles.create', compact('permisos'));
    }

    public function store(Request $request)
    {
        // Obtén los permisos seleccionados del campo oculto
        $permissions = $request->input('permissions');
        // convierte los permissions en un json de elementos separados por comas
        $perms = explode(',', $permissions);
        // Elimina el último elemento del array (una coma)
        array_pop($perms);
        // Con esa lista de IDs buscar los permisos
        $permissions = Permisos::find($perms);


        // Guarda el rol en la base de datos junto con los permisos
        $role = Role::create([
            'name' => $request->input('name'), 
        ]);
        $role->save();
        
        // Eliminar las relaciones antiguas
        $role->permisos()->detach();

        // Agregar las relaciones nuevas
        $role->permisos()->attach($permissions);

        // Redirige a la página deseada después de crear el rol
        return redirect()->route('roles.index');
    }

    public function edit($id)
    {
        $rol = Role::findOrFail($id);
        $perms = Permisos::all(); 
        // Obtener los permisos asociados al rol
        $permisos = $rol->permisos; 

        return view('roles.editar', compact('rol', 'permisos', 'perms'));
    }

    public function update(Request $request, $id)
    {
        $role = Role::findOrFail($id);

        // Validar los datos enviados en el formulario
        $validatedData = $request->validate([
            'name' => 'required|string|max:255'
        ]);

        // Obtén los permisos seleccionados del campo oculto
        $permissions = $request->input('permissions');
        // convierte los permissions en un json de elementos separados por comas
        $perms = explode(',', $permissions); 
        // Con esa lista de IDs buscar los permisos
        $permissions = Permisos::find($perms);

        // Actualizar los campos del rol
        $role->name = $validatedData['name']; 
        $role->save();

        // Eliminar las relaciones antiguas
        $role->permisos()->detach();

        // Agregar las relaciones nuevas
        $role->permisos()->attach($permissions);

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

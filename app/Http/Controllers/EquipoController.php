<?php

namespace App\Http\Controllers;

use App\Models\Categorias;
use App\Models\Componentes;
use App\Models\Equipo;
use Illuminate\Http\Request;

class EquipoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Obtener los equipos con categorias y componentes
        #$equipos = Equipo::with('categoria', 'componentes')->get();
        #$equipos = Equipo::all();
        $equipos = Equipo::with('categoria')->get();
        // Mostrar la vista de equipos
        return view('equipos.index', ['equipos' => $equipos]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Obtener las categorias 
        $categorias = Categorias::all();
        // Obtener los componentes
        $componentes = Componentes::all();
        // Mostrar la vista de creacion de equipos, pasar las categorias y componentes
        return view('equipos.create', ['categorias' => $categorias, 'componentes' => $componentes]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    { 
        // Validar los datos
        $request->validate([
            'nombre' => 'required|max:255',
            'descripcion' => 'required|max:255', 
        ]);

        // Obtener los componentes seleccionados
        $componentes_list = $request->input('componentes');
        // Convertir la lista de componentes en un array 
        $comps = explode(',', $componentes_list); 
        // Eliminar el ultimo elemento del array (el ultimo elemento es un string vacio)
        array_pop($comps); 
        // Con esa lista de IDs buscar los componentes
        $componentes = Componentes::find($comps);


        // Crear el equipo
        $equipo = new Equipo();
        $equipo->nombre = $request->input('nombre');
        $equipo->descripcion = $request->descripcion;
        $equipo->estado = 'Disponible';
        $equipo->categoria_id = $request->input('categoria_id');
        

        $equipo->save(); 
        
        // Agregar los componentes al equipo
        $equipo->componentes()->attach($componentes);
        
        // Redireccionar a la lista de equipos
        return redirect()->route('equipos.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Obtener el equipo
        $equipo = Equipo::findOrFail($id);
        // Obtener las categorias 
        $categorias = Categorias::all();
        // Obtener los componentes
        $componentes = Componentes::all();
        // Mostrar la vista de edicion y pasar el equipo, categorias y componentes
        return view('equipos.editar', ['equipo' => $equipo, 'categorias' => $categorias, 'componentes' => $componentes]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validar los datos
        $request->validate([
            'nombre' => 'required|max:255',
            'descripcion' => 'required|max:255', 
        ]);

        // Obtener los componentes seleccionados
        $componentes_list = $request->input('componentes');
        // Convertir la lista de componentes en un array 
        $comps = explode(',', $componentes_list); 
        // Eliminar el ultimo elemento del array (el ultimo elemento es un string vacio)
        array_pop($comps); 
        // Con esa lista de IDs buscar los componentes
        $componentes = Componentes::find($comps); 


        // Crear el equipo
        $equipo = Equipo::findOrFail($id);
        $equipo->nombre = $request->input('nombre');
        $equipo->descripcion = $request->descripcion;
        $equipo->estado = $request->input('estado');
        $equipo->categoria_id = $request->input('categoria_id');
        

        $equipo->save(); 
        
        // Eliminar las relaciones antiguas
        $equipo->componentes()->detach();
        
        // Agregar los componentes al equipo
        $equipo->componentes()->attach($componentes);
        
        // Redireccionar a la lista de equipos
        return redirect()->route('equipos.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Obtener el equipo
        $equipo = Equipo::findOrFail($id);
        // Eliminar el equipo
        $equipo->delete();
        // Redireccionar a la lista de equipos
        return redirect()->route('equipos.index');
    }
}

<?php

namespace App\Http\Controllers;
 
use App\Models\Componentes;
use Illuminate\Http\Request;

class ComponentesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $componentes = Componentes::all(); 
        return view('componentes.index', ['componentes' => $componentes]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    { 
        return view('componentes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar los datos
        $request->validate([
            'nombre' => 'required|max:255',
            'valor' => 'required|max:255',
            'tipo' => 'required|max:255',
        ]);

        // Crear la categoria
        $componente = new Componentes();
        $componente->nombre = $request->nombre;
        $componente->valor = $request->valor;
        $componente->tipo = $request->tipo;
        $componente->save();

        // Redireccionar a la lista de categorias
        return redirect()->route('componentes.index');
    }

    /**
     * Display the specified resource.
     */ 

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Obtener la categoria
        $componente = Componentes::findOrFail($id);
        // Mostrar la vista de edicion y pasar la categoria
        return view('componentes.editar', ['componente' => $componente]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validar los datos
        $request->validate([
            'nombre' => 'required|max:255',
            'valor' => 'required|max:255',
            'tipo' => 'required|max:255',
        ]);

        // Obtener la categoria
        $componente = Componentes::findOrFail($id);
        // Actualizar la categoria
        $componente->nombre = $request->nombre;
        $componente->valor = $request->valor;
        $componente->tipo = $request->tipo;
        $componente->save();

        // Redireccionar a la lista de categorias
        return redirect()->route('componentes.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Obtener la categoria
        $componente = Componentes::findOrFail($id);
        // Eliminar la categoria
        $componente->delete();

        // Redireccionar a la lista de categorias
        return redirect()->route('componentes.index');
    }
}

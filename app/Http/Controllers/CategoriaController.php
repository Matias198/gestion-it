<?php

namespace App\Http\Controllers;

use App\Models\Categorias;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Obtener todas las categorias
        $categorias = Categorias::all();
        // Retornar la vista con las categorias
        return view('categorias.index', ['categorias' => $categorias]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categorias.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar los datos
        $request->validate([
            'nombre' => 'required|max:255',
            'tipo' => 'required|max:255',
        ]);

        // Crear la categoria
        $categoria = new Categorias();
        $categoria->nombre = $request->nombre;
        $categoria->tipo = $request->tipo;
        $categoria->save();

        // Redireccionar a la lista de categorias
        return redirect()->route('categorias.index');
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
        $categoria = Categorias::findOrFail($id);
        // Retornar la vista con la categoria
        return view('categorias.editar', ['categoria' => $categoria]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validar los datos
        $request->validate([
            'nombre' => 'required|max:255',
            'tipo' => 'required|max:255',
        ]);

        // Obtener la categoria
        $categoria = Categorias::findOrFail($id);
        // Actualizar la categoria
        $categoria->nombre = $request->nombre;
        $categoria->tipo = $request->tipo;
        $categoria->save();

        // Redireccionar a la lista de categorias
        return redirect()->route('categorias.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Obtener la categoria
        $categoria = Categorias::findOrFail($id);
        // Eliminar la categoria
        $categoria->delete();

        // Redireccionar a la lista de categorias
        return redirect()->route('categorias.index');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Equipo;
use App\Models\Solicitudes;

class SolicitudesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Obtener las solicitudes con usuarios y equipos
        $solicitudes = solicitudes::with('usuario')->get();
        $solicitudes = Solicitudes::with('equipo')->get();
        // Mostrar la vista de solicitudes
        return view('solicitudes.index', ['solicitudes' => $solicitudes]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Obtener los usuarios
        //$usuarios = User::all();
        // Obtener los equipos
        $equipos = Equipo::all();
        // Mostrar la vista de creacion de solicitudes, pasar los usuarios y equipos
        return view('solicitudes.create', ['equipos' => $equipos]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar los datos
        $request->validate([
            'motivo' => 'required|max:255'
        ]);

        // Obtener los equipos seleccionados
        $equipos_list = $request->input('equipos');
        // Convertir la lista de equipos en un array
        $equips = explode(',', $equipos_list);
        // Eliminar el ultimo elemento del array (el ultimo elemento es un string vacio)
        array_pop($equips);
        // Busqueda de equipos con la lista de IDs
        $equipos = Equipo::find($equips);

        // Crear la solicitud
        $solicitud = new Solicitudes();
        $solicitud->motivo = $request->input('motivo');
        $solicitud->user_id = session('user')->id;


        $solicitud->save();

        // Agregar los equipos a la solicitud
        $solicitud->equipos()->attach($equipos);

        // Redireccionar a la lista de solicitudes
        return redirect()->route('solicitudes.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Obtener la solicitud
        $solicitud = Solicitud::findOrFail($id);
        // Obtener los usuarios
        //$usuarios = Usuarios::all();
        // Obtener los equipos
        $equipos = Equipo::all();
        // Mostrar la vista de edicion y pasar la solicitud, usuario y equipos
        return view('solicitudes.editar', ['solicitud' => $solicitud, 'equipos' => $equipos]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validar los datos
        $request->validate([
            'motivo' => 'required|max:255'
        ]);

        // Obtener los equipos seleccionados
        $equipos_list = $request->input('equipos');
        // Convertir la lista de equipos en un array
        $equips = explode(',', $equipos_list);
        // Eliminar el ultimo elemento del array (el ultimo elemento es un string vacio)
        array_pop($equips);
        // Busqueda de equipos con la lista de IDs
        $equipos = Equipos::find($equips);


        // Crear la solicitud
        $solicitud = Solicitud::findOrFail($id);
        $solicitud->motivo = $request->input('motivo');
        //$equipo->usuario_id = $request->input('usuario_id');


        $solicitud->save();

        // Eliminar las relaciones antiguas
        $solicitud->equipos()->detach();

        // Agrega los equipos a la solicitud
        $solicitud->equipos()->attach($equipos);

        // Redireccionar a la lista de solicitudes
        return redirect()->route('solicitudes.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Obtener la solicitud
        $solicitud = Solicitud::findOrFail($id);
        // Eliminar la solicitud
        $solicitud->delete();
        // Redireccionar a la lista de solicitudes
        return redirect()->route('solicitudes.index');
    }
}

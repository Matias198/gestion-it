<?php

namespace App\Http\Controllers;

use App\Models\Equipo;
use App\Models\Solicitud;
use App\Models\User;
use Illuminate\Http\Request;

class SolicitudController extends Controller
{
    public function index()
    {
        // Obtener el usuario autenticado
        $user = auth()->user();  

        // Si el usuario es "Usuario Comun" obtener sus solicitudes
        if ($user->role->name == 'Usuario Comun') {
            $solicitudes = Solicitud::where('user_id', $user->id)->get();
            // Retornar la vista con las solicitudes
            return view('solicitud.index', compact('solicitudes'));
        }

        // Si es un usuario del area de sistemas o administrador obtener todas las solicitudes
        $solicitudes = Solicitud::all();
        // Retornar la vista con las solicitudes
        return view('solicitud.index', compact('solicitudes'));
    }

    public function create()
    {
        //Enviar la lista de equipos disponibles
        $equipos = Equipo::where('estado', 'Disponible')->get();
        return view('solicitud.create', compact('equipos'));
    }

    public function aprobar($id)
    {
        // Obtiene la solicitud del id
        $solicitud = Solicitud::find($id);
        // Cambia el estado de la solicitud a aprobado
        $solicitud->estado = 'Aprobado';
        // Cambia el detalle a vacio
        $solicitud->detalle = '';
        // Obtengo los equipos de la solicitud
        $equipos = $solicitud->equipo;
        // Cambia el estado de los equipos a "No disponible"
        foreach ($equipos as $equipo) {
            $equipo->estado = 'No disponible';
            $equipo->save();
        }
        // Guarda los cambios
        $solicitud->save();
        // Redirecciona a la vista de solicitudes
        return redirect()->route('solicitud.index');
    }

    public function denegar($id)
    {
        // Obtiene la solicitud del id
        $solicitud = Solicitud::find($id);
        // Cambia el estado de la solicitud a denegado
        $solicitud->estado = 'Denegado';
        // Cambia el detalle
        $solicitud->detalle = request()->input('detalle');
        // Guarda los cambios
        $solicitud->save();
        // Redirecciona a la vista de solicitudes
        return redirect()->route('solicitud.index');
    }

    public function show($id)
    {
        // Obtiene la solicitud del id
        $solicitud = Solicitud::find($id);
        // Obtiene los equipos de la solicitud
        $equipos = $solicitud->equipo;  
        // Obtengo el usuario solicitante
        $user = User::find($solicitud->user_id);
        // Retorna la vista con la solicitud 
        return view('solicitud.show', [ 'solicitud' => $solicitud, 'equipos' => $equipos, 'user' => $user ]);
    }

    public function solicitar($id){ 
        //Enviar la lista de equipos disponibles
        $equipos = Equipo::where('estado', 'Disponible')->get();
        // Retorna la vista con el equipo marcado
        return view('solicitud.create', [ 'equipo_id' => $id, 'equipos' => $equipos ]);
    }

    public function store(Request $request)
    {
        // Obtener el usuario autenticado
        $user = auth()->user();

        // Obtén los equipos seleccionados del campo oculto
        $equipo_id = $request->input('componentes');
        // Convierte los equipos en un array de elementos
        $array_equipos = explode(',', $equipo_id); 
        // Busca los equipos en la base de datos
        $equipos = Equipo::find($array_equipos);

        // Crear la solicitud
        $solicitud = new Solicitud();
        $solicitud->user_id = $user->id;
        $solicitud->motivo = $request->input('motivo');
        $solicitud->descripcion = $request->input('descripcion');
        $solicitud->estado = 'Pendiente';
        $solicitud->save(); 

        // Asociar los equipos a la solicitud
        $solicitud->equipo()->attach($equipos);


        // Redireccionar a la vista de solicitudes
        return redirect()->route('solicitud.index');
    }

    public function editar($id)
    {
        // Obtiene la solicitud del id
        $solicitud = Solicitud::find($id);
        // Obtiene los equipos que esten disponibles
        $equipos = Equipo::where('estado', 'Disponible')->get();
        // Retorna la vista con la solicitud
        return view('solicitud.editar', [ 'solicitud' => $solicitud, 'equipos' => $equipos ]);
    }

    public function update(Request $request, $id)
    {
        // Obtiene la solicitud del id
        $solicitud = Solicitud::find($id);
        
        // Obtener el usuario autenticado
        $user = auth()->user();

        // Obtén los equipos seleccionados del campo oculto
        $equipo_id = $request->input('componentes');
        // Convierte los equipos en un array de elementos
        $array_equipos = explode(',', $equipo_id); 
        // Busca los equipos en la base de datos
        $equipos = Equipo::find($array_equipos);

        // Actualiza los datos de la solicitud 
        $solicitud->user_id = $user->id;
        $solicitud->motivo = $request->input('motivo');
        $solicitud->descripcion = $request->input('descripcion');
        $solicitud->estado = 'Pendiente';
        $solicitud->save(); 

        // Elimina los equipos asociados a la solicitud
        $solicitud->equipo()->detach();

        // Asociar los equipos a la solicitud
        $solicitud->equipo()->attach($equipos);


        // Redireccionar a la vista de solicitudes
        return redirect()->route('solicitud.index');
    }


    public function destroy($id)
    {
        // Obtiene la solicitud del id
        $solicitud = Solicitud::find($id);
        // Elimina la solicitud
        $solicitud->delete();
        // Redirecciona a la vista de solicitudes
        return redirect()->route('solicitud.index');
    }
}

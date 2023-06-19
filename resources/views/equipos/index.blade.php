@extends('layouts.app')

@section('content')
    <div class="m-2">
        <div class="text-white border-b border-gray-900/10">
            <p class="text-3xl mb-3 mt-3 text-gray-900 dark:text-white">Lista de equipos</p>
            <div class="relative overflow-x-auto">
                <div>
                    <table class="w-full border-2 border-gray-600 text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">ID</th>
                                <th scope="col" class="px-6 py-3">Nombre</th>
                                <th scope="col" class="px-6 py-3">Descripcion</th>
                                <th scope="col" class="px-6 py-3">Categoria</th>
                                <th scope="col" class="px-6 py-3">Tipo</th>
                                <th scope="col" class="px-6 py-3">Componentes</th>
                                <th scope="col" class="px-6 py-3">Motivo Baja</th>
                                <th scope="col" class="px-6 py-3">Fecha Baja</th>
                                <th scope="col" class="px-6 py-3">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="abx acb">
                            @foreach ($equipos as $equipo)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-b-slate-50">
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $equipo->id }}</td>
                                    <td class="px-6 py-4">{{ $equipo->name }}</td>
                                    <td class="px-6 py-4">{{ $equipo->descripcion }}</td>
                                    <td class="px-6 py-4">{{ $equipo->categoria->nombre }}</td>
                                    <td class="px-6 py-4">{{ $equipo->categoria->tipo }}</td>
                                    <td class="px-6 py-4">{{ $equipo->componentes }}</td>
                                    <td class="px-6 py-4">{{ $equipo->motivo_baja }}</td>
                                    <td class="px-6 py-4">{{ $equipo->fecha_baja }}</td>
                                    <td class="px-6 py-4">
                                        <a class="font-medium text-blue-600 dark:text-blue-500 hover:underline"
                                            href="{{ route('equipos.edit', $equipo->id) }}">Editar</a>
                                        <button class="font-medium text-blue-600 dark:text-blue-500 hover:underline"
                                            onclick="borrar({{ $equipo->id }})">Eliminar</button>
                                        <a class="font-medium text-blue-600 dark:text-blue-500" style="display:none">
                                            <form action="{{ route('equipos.destroy', $equipo->id) }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button id="eliminar{{ $equipo->id }}" type="submit" class="hover:underline">Eliminar</button>
                                            </form>
                                        </a>

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-3" style="display: flex; justify-content: center;">
                        <button
                            class="focus:outline-none text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            <a href="{{ route('equipos.create') }}">Crear equipo</a>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function borrar(id) {
            console.log('¿Está seguro de eliminar el equipo?', id);
            Swal.fire({
                title: 'Confirmación',
                text: '¿Estás seguro de eliminar este registro?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, eliminar'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('eliminar' + id).click()
                }
            });
        }
    </script>
@endsection
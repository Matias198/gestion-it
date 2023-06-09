@extends('layouts.app')

@section('content')
    <div class="m-2">
        <div class="text-white border-b border-gray-900/10">
            <p class="text-3xl mb-3 mt-3 text-gray-900 dark:text-white">Lista de equipos</p>
            <div class="relative overflow-x-auto">
                <div>
                    <div>
                        <input type="text" id="filtro-nombre"
                            class="w-full px-4 py-2 mb-4 text-gray-900 bg-gray-100 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Buscar por nombre">
                    </div>
                    <table class="w-full border-2 border-gray-600 text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3"style="max-width: 50px;">ID</th>
                                <th scope="col" class="px-6 py-3"style="max-width: 100px;">Nombre</th>
                                <th scope="col" class="px-6 py-3"style="max-width: 100px;">Descripcion</th>
                                <th scope="col" class="px-6 py-3">Categoria</th>
                                <th scope="col" class="px-6 py-3"style="max-width: 100px;">Tipo</th>
                                <th scope="col" class="px-6 py-3">Componentes</th>
                                <th scope="col" class="px-6 py-3">Estado</th>
                                <!--<th scope="col" class="px-6 py-3">Motivo Baja</th>
                                                    <th scope="col" class="px-6 py-3">Fecha Baja</th>-->
                                @if (session('user')->hasRole((array) ['Administrador', 'Usuario Comun']))
                                    <th scope="col" class="px-6 py-3" style="max-width: 200px;">Acciones</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody class="abx acb">
                            @foreach ($equipos as $equipo)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-b-slate-50">
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"
                                        style="max-width: 50px;">
                                        {{ $equipo->id }}</td>
                                    <td class="px-6 py-4" style="max-width: 100px;">{{ $equipo->nombre }}</td>
                                    <td class="px-6 py-4" style="max-width: 100px;">{{ $equipo->descripcion }}</td>
                                    <td class="px-6 py-4" style="max-width: 100px;">{{ $equipo->categoria->nombre }}</td>
                                    <td class="px-6 py-4" style="max-width: 100px;">{{ $equipo->categoria->tipo }}</td>
                                    <td class="px-6 py-4">
                                        @foreach ($equipo->componentes as $componente)
                                            {{ $componente->nombre }}: {{ $componente->valor }}<br>
                                        @endforeach
                                    </td>
                                    <td class="px-6 py-4" style="max-width: 100px;">{{ $equipo->estado }}</td>
                                    <!--<td class="px-6 py-4">{{ $equipo->motivo_baja }}</td>
                                                        <td class="px-6 py-4">{{ $equipo->fecha_baja }}</td>-->
                                    @if (session('user')->hasRole((array) ['Administrador']))
                                        <td class="px-6 py-4" style="max-width: 200px;">
                                            <a class="font-medium text-blue-600 dark:text-blue-500 hover:underline"
                                                href="{{ route('equipos.edit', $equipo->id) }}">Editar</a>
                                            <br>
                                            <button class="font-medium text-blue-600 dark:text-blue-500 hover:underline"
                                                onclick="borrar({{ $equipo->id }})">Eliminar</button>
                                            <a class="font-medium text-blue-600 dark:text-blue-500"
                                                style="display:none">
                                                <form action="{{ route('equipos.destroy', $equipo->id) }}" method="POST"
                                                    class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button id="eliminar{{ $equipo->id }}" type="submit"
                                                        class="hover:underline">Eliminar</button>
                                                </form>
                                            </a>
                                        </td>
                                    @endif
                                    @if (session('user')->hasRole((array) ['Usuario Comun']))
                                        @if ($equipo->estado == 'Disponible')
                                            <td class="px-6 py-4" style="max-width: 200px;">
                                                <a class="px-3 mx-3 font-medium text-blue-600 dark:text-blue-500 hover:underline"
                                                    href="{{ route('solicitud.solicitar', $equipo->id) }}">Solicitar</a>
                                            </td>
                                        @endif
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @if (session('user')->hasRole((array) ['Administrador']))
                        <div class="mt-3" style="display: flex; justify-content: center;">
                            <button
                                class="focus:outline-none text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                <a href="{{ route('equipos.create') }}">Crear equipo</a>
                            </button>
                        </div>
                    @endif
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

        const filtroNombreInput = document.getElementById('filtro-nombre');

        filtroNombreInput.addEventListener('input', function() {
            const filtro = filtroNombreInput.value.toLowerCase();
            const filas = document.querySelectorAll('tbody tr');

            filas.forEach(function(filaEquipo) {
                const nombreEquipo = filaEquipo.querySelector('td:nth-child(2)').textContent
                    .toLowerCase();
                const descEquipo = filaEquipo.querySelector('td:nth-child(3)').textContent
                    .toLowerCase();
                const categoriaEquipo = filaEquipo.querySelector('td:nth-child(4)').textContent
                    .toLowerCase();
                const tipoEquipo = filaEquipo.querySelector('td:nth-child(5)').textContent
                    .toLowerCase();

                if (nombreEquipo.includes(filtro) || descEquipo.includes(filtro) || categoriaEquipo
                    .includes(filtro) || tipoEquipo.includes(filtro)) {
                    filaEquipo.style.display = 'table-row';
                } else {
                    filaEquipo.style.display = 'none';
                }
            });
        });
    </script>
@endsection

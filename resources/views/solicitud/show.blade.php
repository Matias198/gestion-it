<!-- resources/views/users/create.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="px-8">
        <div class="text-white border-b border-gray-900/10">
            <p class="text-3xl mb-3 mt-3 text-gray-900 dark:text-white">Ver solicitud</p>
            <div class="mb-6">
                <label for="estado" class=" block mb-2 text-sm font-medium text-gray-900 dark:text-white">Estado</label>
                <input type="text" id="estado" name="estado"
                    class="cursor-default read-only:text-gray-100 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Ingrese un motivo" required value="{{ $solicitud->estado }}" readonly
                    @if ($solicitud->estado == 'Aprobado') style="background-color: green; font-weight: bold"
                    @elseif($solicitud->estado == 'Denegado')
                    style="background-color: red; font-weight: bold"
                    @else
                    style="background-color: rgb(255, 250, 00); color: black ; font-weight: bold" @endif>
            </div>
            @if ($solicitud->estado == 'Denegado')
                <div class="mb-6">
                    <label for="detalle" class=" block mb-2 text-sm font-medium text-gray-900 dark:text-white">Motivo de
                        rechazo de solicitud</label>
                    <input type="text" id="detalle" name="detalle"
                        class="cursor-default read-only:text-gray-100 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="por que? no hay por que" required value="{{ $solicitud->detalle }}" readonly>
                </div>
            @endif
            <div class="mb-6">
                <label for="motivo" class=" block mb-2 text-sm font-medium text-gray-900 dark:text-white">Motivo</label>
                <input type="text" id="motivo" name="motivo"
                    class="cursor-default read-only:text-gray-100 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Ingrese un motivo" required value="{{ $solicitud->motivo }}" readonly>
            </div>
            <div class="mb-6">
                <label for="descripcion"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Descripcion</label>
                <textarea id="descripcion" name="descripcion" rows="4" readonly
                    class="cursor-default read-only:text-gray-100 block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Escriba una descripcion acerca de su solicitud">{{ $solicitud->descripcion }}</textarea>
            </div>
            <div class="mb-6">
                <label for="solicitante"
                    class=" block mb-2 text-sm font-medium text-gray-900 dark:text-white">Solicitante</label>
                <input type="text" id="solicitante" name="solicitante"
                    class="cursor-default read-only:text-gray-100 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Ingrese un motivo" required value="{{ $user->name }} (ID:{{ $user->id }})" readonly>
            </div>
            @if (session('user')->hasRole((array) ['Administrador', 'Usuarios del Área de Sistemas']))
                <label for="equipos-box" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Detalle de
                    estados
                    <br>
                    <input disabled checked id="red-checkbox" type="checkbox" value=""
                        class="w-4 h-4 text-red-600 bg-gray-100 border-gray-300 rounded focus:ring-red-500 dark:focus:ring-red-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <label for="red-checkbox" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">No
                        disponibles</label>
                    <br>
                    <input disabled checked id="green-checkbox" type="checkbox" value=""
                        class="w-4 h-4 text-green-600 bg-gray-100 border-gray-300 rounded focus:ring-green-500 dark:focus:ring-green-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <label for="green-checkbox"
                        class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Disponibles</label>
                    <br>
                    <input disabled checked id="green-checkbox" type="checkbox" value=""
                        class=" w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <label for="green-checkbox"
                        class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Solicitados
                        por el Cliente</label>
                </label>
                <br>
            @endif
            <label for="equipos-box" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                Equipos
            </label>
            <div id="equipos-box"></div>
            <table class=" mb-4 w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        @if (session('user')->hasRole((array) ['Administrador', 'Usuarios del Área de Sistemas']))
                            <th scope="col" class="px-6 py-3">
                                Estado
                            </th>
                        @endif
                        <th scope="col" class="px-6 py-3">
                            Solicitado
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Equipos
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($equipos as $equipo)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            @if (session('user')->hasRole((array) ['Administrador', 'Usuarios del Área de Sistemas']))
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    @if ($equipo->estado != 'Disponible' && !($solicitud->equipo->contains($equipo) && $solicitud->estado == 'Aprobado'))
                                        <input disabled checked type="checkbox"
                                            class=" mr-2 w-4 h-4 text-red-600 bg-gray-100 border-gray-300 rounded focus:ring-red-500 dark:focus:ring-red-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    @else
                                        <input disabled checked type="checkbox"
                                            class=" mr-2 w-4 h-4 text-green-600 bg-gray-100 border-gray-300 rounded focus:ring-green-500 dark:focus:ring-green-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    @endif
                                </th>
                            @endif
                            <td class="px-6 py-4">
                                <input disabled id="default-checkbox" type="checkbox"
                                    @foreach ($solicitud->equipo as $equipoAux)
                        @if ($equipoAux->id == $equipo->id)
                            checked
                        @endif @endforeach
                                    value="{{ $equipo->id }}"
                                    class=" w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            </td>
                            <td class="px-6 py-4" style="word-wrap: break-word">
                                <label for="default-checkbox"
                                    class="text-sm font-medium text-gray-900 dark:text-gray-300">{{ $equipo->nombre }}:
                                    @if (count($equipo->componentes) > 0)
                                        @foreach ($equipo->componentes as $componente)
                                            {{ $componente->nombre }}: {{ $componente->valor }}.
                                        @endforeach
                                    @else
                                        {{ $equipo->descripcion }}
                                    @endif
                                </label>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
            @if (session('user')->hasRole((array) ['Administrador', 'Usuarios del Área de Sistemas']))
                <div class="felx justify-between" style="display: flex; justify-content: space-between">
                    <a href="{{ route('solicitud.aprobar', $solicitud->id) }}"
                        class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 focus:outline-none dark:focus:ring-green-800">
                        Aprobar solicitud
                    </a>
                    <button class="font-medium text-red-600 dark:text-red-500 hover:underline"
                        onclick="borrar({{ $solicitud->id }})">Eliminar solicitud
                        <span><strong>(Permanente)</strong></span>
                    </button>
                    <a class="px-3 mx-3 font-medium text-blue-600 dark:text-blue-500" style="display:none">
                        <form action="{{ route('solicitud.destroy', $solicitud->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button id="eliminar{{ $solicitud->id }}" type="submit" class="hover:underline">Eliminar
                                solicitud</button>
                        </form>
                    </a>  
                </div>
                <form class="mb-3 mt-3" action="{{ route('solicitud.denegar', $solicitud->id) }}">
                    @csrf
                    <div class="mb-6">
                        <label for="detalle"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Descripcion</label>
                        <textarea id="detalle" name="detalle" rows="4" required
                            class="cursor-default read-only:text-gray-100 block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Escriba una descripcion acerca de su solicitud"></textarea>
                    </div>
                    <button type="submit"
                        class="hover:underline text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 focus:outline-none dark:focus:ring-red-800">
                        Denegar solicitud
                    </button>
                </form>
            @endif
        </div>
    </div>
    <script>
        function borrar(id) {
            console.log('¿Está seguro de eliminar el rol?', id);
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

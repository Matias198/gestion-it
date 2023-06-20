<!-- resources/views/equipos/edit.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="mx-auto max-w-2xl">
        <div class="text-white border-b border-gray-900/10">
            <p class="text-3xl mb-3 mt-3 text-gray-900 dark:text-white">Editar equipos</p>
            <form action="{{ route('equipos.update', $equipo->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-6">
                    <label for="nombre" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre</label>
                    <input type="text" id="nombre" name="nombre"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        value="{{ $equipo->nombre }}"
                        required>
                </div>
                <div class="mb-6">
                    <label for="descripcion"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Descripcion</label>
                    <input type="text" id="descripcion" name="descripcion"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        value="{{ $equipo->descripcion }}"
                        required>
                </div>
                <label for="categoria"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Categoria</label>
                <select id="categoria" name="categoria"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    onchange="updateHiddenField(this)">
                    <option value="" disabled selected>Seleccione una categoria</option>
                    @foreach ($categorias as $categoria)
                        <!-- Si la categoria es igual a la categoria del $equipo entonces selected -->
                        <option @if ($categoria->id == $equipo->categoria_id) selected @endif
                         value="{{ $categoria->id }}">{{ $categoria->nombre }}</option> 
                    @endforeach
                </select>
                <br>
                <label for="filtro-nombre" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Filtrar por
                    nombre</label>
                <input type="text" id="filtro-nombre"
                    class="w-full px-4 py-2 mb-4 text-gray-900 bg-gray-100 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Ingrese el nombre"> 

                <label for="componentes-box"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Componentes</label>
                <div id="componentes-box"></div>
                @foreach ($componentes as $componente)
                    <div id="componentes" class="flex items-center mb-4">
                        <!-- Si el componente es igual al componente del $equipo->componentes entonces checked -->
                        <input id="default-checkbox" type="checkbox" value="{{ $componente->id }}"
                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                            @foreach ($equipo->componentes as $comp)
                                @if ($comp->id == $componente->id) checked @endif
                            @endforeach
                        >
                        <label for="default-checkbox"
                            class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ $componente->nombre }}:
                            {{ $componente->valor }}</label>
                    </div>
                @endforeach
                <br>
                <button type="submit"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Guardar
                    Equipo</button>
                <input type="" id="categoria_id" name="categoria_id" value="" style="color:black">
                <input type="" id="comps" name="componentes" value="" style="color:black">
            </form>
        </div>
    </div>
    <script>
        function updateHiddenField(selectElement) {
            var selectedValue = selectElement.value;
            document.getElementById('categoria_id').value = selectedValue;
        }

        const filtroNombreInput = document.getElementById('filtro-nombre');

        filtroNombreInput.addEventListener('input', function() {
            const filtro = filtroNombreInput.value.toLowerCase();
            const componentes = document.querySelectorAll('#componentes');
            
            componentes.forEach(function(componente) {
                const nombreComponente = componente.querySelector('label').textContent.toLowerCase(); 
                if (nombreComponente.includes(filtro)) {
                    componente.style.display = 'block';
                } else {
                    componente.style.display = 'none';
                }
            });
        });
        // Get the componentes element
        const comps = document.getElementById('comps');
        const componentes = document.querySelectorAll('input[type="checkbox"]');

        // Recorre cada checkbox
        componentes.forEach(function(checkbox) {
            // Agrega el evento click a cada checkbox
            checkbox.addEventListener('click', function() {
                if (comps.value.includes(checkbox.value)) {
                    // El valor ya está presente en comps.value, lo quitamos
                    comps.value = comps.value.replace(checkbox.value + ",", '');
                } else {
                    // El valor no está presente en comps.value, lo agregamos
                    comps.value += checkbox.value + ",";
                }
            });
        });

        // Cuando el documento termina de cargar, actualizar los input hidden con los valores de los checkbox y del categoria_id
        window.addEventListener('load', function() {
            const categoria = document.getElementById('categoria');
            const categoria_id = document.getElementById('categoria_id');
            const componentes = document.querySelectorAll('input[type="checkbox"]');
            const comps = document.getElementById('comps');

            categoria_id.value = categoria.value;

            componentes.forEach(function(checkbox) {
                if (checkbox.checked) {
                    comps.value += checkbox.value + ",";
                }
            });
        });
    </script>
@endsection

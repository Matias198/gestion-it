<!-- resources/views/categorias/edit.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="mx-auto max-w-2xl">
        <div class="text-white border-b border-gray-900/10">
            <p class="text-3xl mb-3 mt-3 text-gray-900 dark:text-white">Editar categorias</p>
            <form action="{{ route('categorias.update', $categoria->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-6">
                    <label for="nombre" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre</label>
                    <input type="text" id="nombre" name="nombre"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        value="{{ $categoria->nombre }}" required>
                </div>
                <label for="tipo" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tipo de categoria</label>
                <select id="tipo" name="tipo"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    onchange="updateHiddenField(this)">
                    <option value="" disabled selected>Seleccione un tipo</option>
                    <option value="Hardware" @if ($categoria->tipo === 'Hardware') selected @endif>Hardware</option>
                    <option value="Software" @if ($categoria->tipo === 'Software') selected @endif>Software</option>
                </select>
                <br><br>
                <button type="submit"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Guardar
                    categoria</button>
                <input type="hidden" id="tipo_componente" name="tipo_componente" value="{{ $categoria->tipo }}"
                    style="color:black">
            </form>
        </div>
    </div>
    <script>
        function updateHiddenField(selectElement) {
            var selectedValue = selectElement.value;
            document.getElementById('tipo_componenete').value = selectedValue;
        }
    </script>
@endsection

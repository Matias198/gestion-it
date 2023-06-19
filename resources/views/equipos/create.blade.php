<!-- resources/views/users/create.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="mx-auto max-w-2xl">
        <div class="text-white border-b border-gray-900/10">
            <p class="text-3xl mb-3 mt-3 text-gray-900 dark:text-white">Crear Equipo</p>
            <form action="{{ route('equipos.store') }}" method="POST">
                @csrf
                <div class="mb-6">
                    <label for="nombre" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre</label>
                    <input type="text" id="nombre" name="name"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        required>
                </div>
                <div class="mb-6">
                    <label for="descripcion" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Descripcion</label>
                    <input type="text" id="descripcion" name="descripcion"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        required>
                </div>
                <div class="mb-6">
                    <label for="descripcion" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Descripcion</label>
                    <input type="text" id="descripcion" name="descripcion"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        required>
                </div>
                
                
                <label for="role" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Rol</label>
                <select id="role" name="role"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    onchange="updateHiddenField(this)"> 
                    <option value="" disabled selected>Seleccione un rol</option>
                    @foreach ($roles as $role)
                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                    @endforeach
                </select>
                <br><br>
                <button type="submit"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Crear
                    Equipo</button>
                <input type="hidden" id="role_id" name="role_id" value="" style="color:black">
            </form>
        </div>
    </div>
    <script>
        function updateHiddenField(selectElement) {
            var selectedValue = selectElement.value;
            document.getElementById('role_id').value = selectedValue;
        }
    </script>
@endsection

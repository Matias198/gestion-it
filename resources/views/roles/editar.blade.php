<!-- resources/views/rols/edit.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="mx-auto max-w-2xl">
        <div class="text-white border-b border-gray-900/10">
            <p class="text-3xl mb-3 mt-3 text-gray-900 dark:text-white">Editar Rol</p>
            <form action="{{ route('roles.update', $rol->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-6">
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre</label>
                    <input type="name" id="name" name="name"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        value="{{ $rol->name }}" required>
                </div>
                <div class="mb-6">
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" value="ADMINISTRAR_USUARIOS" class="sr-only peer"
                            {{ in_array('ADMINISTRAR_USUARIOS', $permisos) ? 'checked' : '' }}>
                        <div
                            class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600">
                        </div>
                        <span class="ml-3 text-sm font-medium text-gray-900 dark:text-gray-300">Administrar Usuarios</span>
                    </label>
                    <br>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" value="ADMINISTRAR_ROLES" class="sr-only peer"
                            {{ in_array('ADMINISTRAR_ROLES', $permisos) ? 'checked' : '' }}>
                        <div
                            class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600">
                        </div>
                        <span class="ml-3 text-sm font-medium text-gray-900 dark:text-gray-300">Administrar Roles</span>
                    </label>
                    <br>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" value="ADMINISTRAR_EQUIPOS" class="sr-only peer"
                            {{ in_array('ADMINISTRAR_EQUIPOS', $permisos) ? 'checked' : '' }}>
                        <div
                            class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600">
                        </div>
                        <span class="ml-3 text-sm font-medium text-gray-900 dark:text-gray-300">Administrar Equipos</span>
                    </label>
                    <br>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" value="ADMINISTRAR_SOLICITUDES" class="sr-only peer"
                            {{ in_array('ADMINISTRAR_SOLICITUDES', $permisos) ? 'checked' : '' }}>
                        <div
                            class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600">
                        </div>
                        <span class="ml-3 text-sm font-medium text-gray-900 dark:text-gray-300">Administrar
                            Solicitudes</span>
                    </label>
                    <br>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" value="GESTIONAR_SOLICITUDES" class="sr-only peer"
                            {{ in_array('GESTIONAR_SOLICITUDES', $permisos) ? 'checked' : '' }}>
                        <div
                            class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600">
                        </div>
                        <span class="ml-3 text-sm font-medium text-gray-900 dark:text-gray-300">Gestionar Solicitudes</span>
                    </label>
                    <br>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" value="SOLICITAR_EQUIPOS" class="sr-only peer"
                            {{ in_array('SOLICITAR_EQUIPOS', $permisos) ? 'checked' : '' }}>
                        <div
                            class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600">
                        </div>
                        <span class="ml-3 text-sm font-medium text-gray-900 dark:text-gray-300">Solicitar Equipos</span>
                    </label>
                </div>
                <button type="submit"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Guardar
                    Rol</button>
                <input type="hidden" id="permissions" name="permissions" value="" style="color:black">
            </form>
        </div>
    </div>
    <script>
        // Espera a que se cargue el documento
        document.addEventListener('DOMContentLoaded', function() {
            // Obtén todos los elementos de checkbox
            const checkboxes = document.querySelectorAll('input[type="checkbox"]');
            const hiddenInput = document.getElementById('permissions');

            // Función para obtener los valores de los checkboxes marcados
            function getCheckedValues() {
                const checkedValues = Array.from(checkboxes)
                    .filter(function(checkbox) {
                        return checkbox.checked;
                    })
                    .map(function(checkbox) {
                        return checkbox.value;
                    });

                return checkedValues;
            }

            // Actualiza el valor del campo oculto con los valores marcados
            hiddenInput.value = getCheckedValues().join(',');

            // Agrega un evento de cambio a todos los checkboxes
            checkboxes.forEach(function(checkbox) {
                checkbox.addEventListener('change', function() {
                    // Actualiza el valor del campo oculto cuando cambia el estado de un checkbox
                    hiddenInput.value = getCheckedValues().join(',');
                });
            });
        });
    </script>
@endsection

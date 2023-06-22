<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title>GestiónIT</title>
    <link rel="icon" href="{{ asset('assets/img/favicon.svg') }}" type="image/x-icon" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <!-- Styles -->
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.css" rel="stylesheet" />
    @vite('resources/css/app.css')
</head>

<body class="antialiased bg-slate-900">
    <h1 class="text-center mt-16 text-white text-2xl">GestionIT <br> • Registrar Cliente •</h1>
    <div style="display: flex; height: 70vh; align-items: center">
        <div class="text-center bg-slate-800 p-10 rounded-lg shadow-black shadow-md"
            style="margin: 0 auto; vertical-align: middle;">
            <form action="{{ route('auth.register.submit') }}" method="POST">
                @csrf
                <table>
                    <tr>
                        <td class="p-5">
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Ingrese su
                                nombre</label>
                            <div class="relative mb-6">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor"
                                        viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"></path>
                                    </svg>
                                </div>
                                <input type="text" id="name" name="name"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    required>
                            </div>
                        </td>
                        <td class="p-5">
                            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Ingrese su
                                email</label>
                            <div class="relative mb-6">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor"
                                        viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path>
                                        <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path>
                                    </svg>
                                </div>
                                <input type="email" id="input-group-1" name="email"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="mail@mail.com">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="p-5">
                            <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Ingrese su
                                contraseña</label>
                            <div class="relative mb-6">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z">
                                        </path>
                                    </svg>
                                </div>
                                <input type="password" id="password" name="password"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    required onchange="checkPasswordMatch()" value="">
                        </td>
                        <td class="p-5">
                            <label for="confirmPassword" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Vuelva a ingresar su
                                contraseña</label>
                            <div class="relative mb-6">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z">
                                        </path>
                                    </svg>
                                </div>
                                <input type="password" id="confirmPassword" name="confirmPassword"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    required onchange="checkPasswordMatch()" value=""> 
                        </td>
                    </tr>
                </table> 

                <button type="submit" disabled id="submit"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Registrar</button>
            </form>
            <br>
            <label for="btn-registro" class="text-white">Ya tenés cuenta?</label>
            <a id="btn-registro" class="font-medium text-blue-600 dark:text-blue-500 hover:underline"
                href="{{ route('auth.login') }}">Inicia sesión ahora</a>
        </div>
    </div>

    <script>
        function checkPasswordMatch() {
            var password = document.getElementById("password").value;
            var confirmPassword = document.getElementById("confirmPassword").value;
            var submit = document.getElementById("submit");

            if (password === confirmPassword) {
                // Las contraseñas coinciden
                // Puedes realizar acciones adicionales aquí, como habilitar el botón de registro
                submit.disabled = false;
                console.log("Las contraseñas coinciden");
            } else {
                // Las contraseñas no coinciden
                // Puedes mostrar un mensaje de error o realizar otras acciones
                submit.disabled = true;
                console.log("Las contraseñas no coinciden");
            }
        }
    </script>
</body>

</html>

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next, $role)
    {

        // El usuario no está autenticado, redirigirlo a la página de inicio de sesión
        if (!auth()->check()) {
            return redirect('/login');
        }
 
        // Crear un array de roles a partir de $role
        $roles = explode('|', $role);

        // El usuario no tiene el rol requerido, mostrar un mensaje de error o redirigirlo a una página de acceso denegado
        if (!$request->user()->hasRole($roles)) {
            abort(403, 'Acceso denegado');
        }

        return $next($request);
    }
}

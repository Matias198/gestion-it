<?php

namespace Database\Seeders;

use App\Models\Permisos;
use App\Models\Role;
use App\Models\User; 
use Illuminate\Database\Seeder;

class SuperusuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear el superusuario
        $superusuario = User::create([
            'name' => 'Super Usuario',
            'email' => 'super@usuario',
            'password' => bcrypt('12345678'),
        ]); 

        // Obtén todos los permisos existentes
        $permisos = Permisos::all();

        // Crea el rol "Super Usuario"
        $rol = Role::create([
            'name' => 'Administrador',
        ]); 

        // Asigna todos los permisos al rol "Super Usuario"
        $rol->permisos()->attach($permisos);

        // Asigna el rol "Super Usuario" al usuario Super Usuario
        $superusuario->role_id = $rol->id;
        $superusuario->save();

        //------------------------
        
        // Crear el usuario de area de informatica
        $user = User::create([
            'name' => 'Gerente Area de Informatica',
            'email' => 'area@info',
            'password' => bcrypt('12345678'),
        ]);
        

        // Obtén los permisos "GESTIONAR_SOLICITUDES", "GESTIONAR_USUARIOS" y "GESTIONAR_SOLICITUDES"
        $permisos = Permisos::whereIn('nombre', ['GESTIONAR_SOLICITUDES', 'GESTIONAR_USUARIOS', 'GESTIONAR_SOLICITUDES'])->get();


        // Crea el rol "Usuarios del Área de Sistemas"
        $rol = Role::create([
            'name' => 'Usuarios del Área de Sistemas',
        ]); 

        // Asigna todos los permisos al rol "Usuarios del Área de Sistemas"
        $rol->permisos()->attach($permisos);

        // Asigna el rol "Usuarios del Área de Sistemas" al usuario Gerente Area de Informatica
        $user->role_id = $rol->id;
        $user->save();

        //------------------------ 

        // Obtén los permisos "GESTIONAR_SOLICITUDES", "GESTIONAR_EQUIPOS" y "SOLICITAR_EQUIPOS"
        $permisos = Permisos::whereIn('nombre', ['GESTIONAR_SOLICITUDES', 'GESTIONAR_EQUIPOS', 'SOLICITAR_EQUIPOS'])->get();


        // Crea el rol "Usuario Comun"
        $rol = Role::create([
            'name' => 'Usuario Comun',
        ]); 

        // Asigna todos los permisos al rol "Usuario Comun"
        $rol->permisos()->attach($permisos);

    }
}

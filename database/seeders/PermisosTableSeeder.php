<?php


namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermisosTableSeeder extends Seeder
{
    public function run()
    {
        // Array de permisos a insertar
        $permisos = [
            ['nombre' => 'ADMINISTRAR_USUARIOS'],
            ['nombre' => 'ADMINISTRAR_ROLES'],
            ['nombre' => 'ADMINISTRAR_EQUIPOS'],
            ['nombre' => 'ADMINISTRAR_SOLICITUDES'],
            ['nombre' => 'GESTIONAR_SOLICITUDES'],
            ['nombre' => 'GESTIONAR_USUARIOS'],
            ['nombre' => 'GESTIONAR_EQUIPOS'],
            ['nombre' => 'SOLICITAR_EQUIPOS'],
        ];

        // Insertar los permisos en la tabla
        foreach ($permisos as $permiso) {
            DB::table('permisos')->insert([
                'nombre' => $permiso['nombre'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}


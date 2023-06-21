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
            'name' => 'Super Usuario',
        ]); 

        // Asigna todos los permisos al rol "Super Usuario"
        $rol->permisos()->attach($permisos);

        // Asigna el rol "Super Usuario" al usuario Super Usuario
        $superusuario->role_id = $rol->id;
        $superusuario->save();
    }
}

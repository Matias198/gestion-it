<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EquiposTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Array de Equipos a insertar
        $equipos = [
            ['nombre' => 'Computadoras de Escritorio', 'descripcion' => 'Edición de Video','categoria_id'=>'1'],
            ['nombre' => 'Computadoras de Escritorio', 'descripcion' => 'Programación','categoria_id'=>'1'],
            ['nombre' => 'Impresora','descripcion' => 'Epson WorkForce WF-7720', 'categoria_id'=>'4'],
            ['nombre' => 'Impresora','descripcion' => 'HP LaserJet Pro MFP M428fdw', 'categoria_id'=>'4'],
            ['nombre' => 'Impresora','descripcion' => 'Canon PIXMA TS9120', 'categoria_id'=>'4'],
            ['nombre' => 'Impresora','descripcion' => 'Brother HL-L2380DW', 'categoria_id'=>'4'],
            ['nombre' => 'Impresora','descripcion' => 'Brother DCP-L2540DW', 'categoria_id'=>'4'],
        ];

        // Insertar los componentes de equipos en la tabla
        foreach ($equipos as $equipo) {
            DB::table('equipos')->insert([
                'nombre' => $equipo['nombre'],
                'descripcion' => $equipo['descripcion'],
                'categoria_id' => $equipo['categoria_id'],
                'estado' => 'Disponible',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
        // Array de componentes de equipos a insertar
        $componentes = [
            ['equipo_id' => '1','componentes_id'=>'5'],
            ['equipo_id' => '1','componentes_id'=>'15'],
            ['equipo_id' => '1','componentes_id'=>'18'],
            ['equipo_id' => '1','componentes_id'=>'21'],
            ['equipo_id' => '2','componentes_id'=>'4'],
            ['equipo_id' => '2','componentes_id'=>'14'],
            ['equipo_id' => '2','componentes_id'=>'16'],
            ['equipo_id' => '2','componentes_id'=>'22'],
        ];
        foreach ($componentes as $componente) {
            DB::table('equipo_componente')->insert([
                'equipo_id' => $componente['equipo_id'],
                'componentes_id' => $componente['componentes_id'],
            ]);
        }
    }
}

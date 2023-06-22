<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Array de Categorias a insertar
        $categorias = [
            ['nombre' => 'Computadoras de Escritorio', 'tipo'=>'Hardware'],
            ['nombre' => 'Portátiles o Laptops', 'tipo'=>'Hardware'],
            ['nombre' => 'Servidores', 'tipo'=>'Hardware'],
            ['nombre' => 'Impresoras', 'tipo'=>'Hardware'],
            ['nombre' => 'Escáneres', 'tipo'=>'Hardware'],
            ['nombre' => 'Dispositivos Móviles', 'tipo'=>'Hardware'],
            ['nombre' => 'Dispositivos de red (routers, switches, puntos de acceso)', 'tipo'=>'Hardware'],
            ['nombre' => 'Periféricos (Teclados, Mouse o Ratones, Monitores, Parlantes, Auriculares)', 'tipo'=>'Hardware'],
            ['nombre' => 'Almacenamiento Interno (Discos Duros o HDD, SSD)', 'tipo'=>'Hardware'],
            ['nombre' => 'Almacenamiento Externo (Diskette, CD, DVD, Blue-Ray, Pendrive, USB, Micro SD)', 'tipo'=>'Hardware'],
            ['nombre' => 'Placas de expansión (Placa de red, Placa de audio, Placa de video o Tarjeta de Video)', 'tipo'=>'Hardware'],
            ['nombre' => 'Unidad Óptica', 'tipo'=>'Hardware'],
            ['nombre' => 'Batería', 'tipo'=>'Hardware'],
            ['nombre' => 'Memoría RAM', 'tipo'=>'Hardware'],
            ['nombre' => 'Procesador', 'tipo'=>'Hardware'],
            ['nombre' => 'Proyectores', 'tipo'=>'Hardware'],
            ['nombre' => 'Sistema Operativo', 'tipo'=>'Software'],
            ['nombre' => 'Aplicaciones de Productividad (Microsoft Office, Google Suite)', 'tipo'=>'Software'],
            ['nombre' => 'Software de Diseño Gráfico (Adobe Photoshop, Illustrator)', 'tipo'=>'Software'],
            ['nombre' => 'Herramientas de Desarrollo (IDEs, editores de código)', 'tipo'=>'Software'],
            ['nombre' => 'Software de Gestión de Proyectos (Jira, Trello)', 'tipo'=>'Software'],
            ['nombre' => 'Herramientas de Versionado (Git, Bitbucket)', 'tipo'=>'Software'],
        ];

        // Insertar las categorías en la tabla
        foreach ($categorias as $categoria) {
            DB::table('categorias')->insert([
                'nombre' => $categoria['nombre'],
                'tipo' => $categoria['tipo'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}

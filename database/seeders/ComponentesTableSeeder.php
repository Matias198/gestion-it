<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ComponentesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Array de componentes a insertar
        $componentes = [
            ['nombre' => 'Procesador', 'valor' => 'Intel Core i9-11900K 3.5 GHz', 'tipo' => 'Hardware'],
            ['nombre' => 'Procesador', 'valor' => 'AMD Ryzen 9 5950X 3.4 GHz', 'tipo' => 'Hardware'],
            ['nombre' => 'Procesador', 'valor' => 'Intel Core i7-11700K 3.6 GHz', 'tipo' => 'Hardware'],
            ['nombre' => 'Procesador', 'valor' => 'AMD Ryzen 7 5800X 3.8 GHz', 'tipo' => 'Hardware'],
            ['nombre' => 'Procesador', 'valor' => 'Intel Core i5-11600K 3.9 GHz', 'tipo' => 'Hardware'],
            ['nombre' => 'Procesador', 'valor' => 'AMD Ryzen 5 5600X 3.7 GHz', 'tipo' => 'Hardware'],
            ['nombre' => 'Procesador', 'valor' => 'Intel Core i9-10900K 3.7 GHz', 'tipo' => 'Hardware'],
            ['nombre' => 'Procesador', 'valor' => 'AMD Ryzen 9 5900X 3.7 GHz', 'tipo' => 'Hardware'],
            ['nombre' => 'Procesador', 'valor' => 'Intel Core i7-10700K 3.8 GHz', 'tipo' => 'Hardware'],
            ['nombre' => 'Procesador', 'valor' => 'AMD Ryzen 7 3700X 3.6 GHz', 'tipo' => 'Hardware'],
            ['nombre' => 'Memoria RAM', 'valor' => 'Corsair Vengeance RGB Pro 16GB DDR4', 'tipo' => 'Hardware'],
            ['nombre' => 'Memoria RAM', 'valor' => 'Crucial Ballistix 32GB DDR4', 'tipo' => 'Hardware'],
            ['nombre' => 'Memoria RAM', 'valor' => 'Kingston HyperX Fury 8GB DDR4', 'tipo' => 'Hardware'],
            ['nombre' => 'Memoria RAM', 'valor' => 'G.Skill Trident Z Neo 64GB DDR4', 'tipo' => 'Hardware'],
            ['nombre' => 'Memoria RAM', 'valor' => 'ADATA XPG Spectrix D60G 16GB DDR4', 'tipo' => 'Hardware'],
            ['nombre' => 'Almacenamiento Interno', 'valor' => 'Seagate BarraCuda 2TB HDD', 'tipo' => 'Hardware'],
            ['nombre' => 'Almacenamiento Interno', 'valor' => 'Western Digital Blue 1TB HDD', 'tipo' => 'Hardware'],
            ['nombre' => 'Almacenamiento Interno', 'valor' => 'Samsung 970 EVO Plus 500GB SSD', 'tipo' => 'Hardware'],
            ['nombre' => 'Almacenamiento Interno', 'valor' => 'Crucial MX500 1TB SSD', 'tipo' => 'Hardware'],
            ['nombre' => 'Almacenamiento Interno', 'valor' => 'SanDisk Ultra 3D NAND 2TB SSD', 'tipo' => 'Hardware'],
            ['nombre' => 'Sistemas Operativos', 'valor' => 'Windows 10 Pro', 'tipo' => 'Software'],
            ['nombre' => 'Sistemas Operativos', 'valor' => 'Linux Ubuntu 20.04 LTS', 'tipo' => 'Software'],
            ['nombre' => 'Sistemas Operativos', 'valor' => 'Windows 7', 'tipo' => 'Software'],
            ['nombre' => 'Sistemas Operativos', 'valor' => 'Android 12', 'tipo' => 'Software'],
            ['nombre' => 'Sistemas Operativos', 'valor' => 'iOS 15', 'tipo' => 'Software'],
        ];

        // Insertar los componentes en la tabla
        foreach ($componentes as $componente) {
            DB::table('componentes')->insert([
                'nombre' => $componente['nombre'],
                'valor' => $componente['valor'],
                'tipo' => $componente['tipo'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}

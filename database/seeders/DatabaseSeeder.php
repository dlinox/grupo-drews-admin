<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Configuracion;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        
        Configuracion::create([
            'web_nombre' => 'GRUPO DREWS',
            'web_descripcion' => 'Grupo empresarial con más de 10 años de experiencia en la Región Puno y el Sur del Perú. Brindamos servicios de alquiler de Camionetas 4X4, a   lquiler de maquinaria pesada y otros Vehículos motorizados.',
        ]);

        User::create([
            'name' => 'Drews',
            'email' => 'drews@grupodrews.com.pe',
            'password' => 'drews@grupodrews.com.pe'
        ]);

        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => 'admin@gmail.com'
        ]);


        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // <--- Importante: Añade esta línea

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Desactivar las comprobaciones de claves foráneas temporalmente
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;'); // <-- Añade esta línea

        // Llama a tus seeders
        $this->call([
            // Aquí solo necesitamos el ProductSeeder por ahora.
            // Si en el futuro tienes un UserSeeder u otros, los añadirías aquí.
            ProductSeeder::class,
        ]);

        // Reactivar las comprobaciones de claves foráneas
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;'); // <-- Añade esta línea
    }
}
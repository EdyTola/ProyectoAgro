<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Product::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $categories = [
            'Productos agrícolas',
            'Insumos agrícolas',
            'Maquinaria agrícola',
            'Control de plagas',
            'Producto Animal',
            'Alimentos para ganado',
            'Medicamentos veterinarios',
            'Herramientas agrícolas',
            'Otros productos'
        ];

        // Nombres de archivo de imágenes LOCALES que deberás colocar en public/images/
        $imageFileNames = [
            'Productos agrícolas' => [
                'productos_agricolas_1.png', // Ejemplo para Maíz Morado
                'productos_agricolas_2.png', // Ejemplo para Papa Nativa
                'productos_agricolas_3.png', // Ejemplo para Quinua
                'productos_agricolas_4.png', // Ejemplo genérico
            ],
            'Insumos agrícolas' => [
                'insumos_agricolas_1.png', // Ejemplo para Fertilizante
                'insumos_agricolas_2.png', // Ejemplo para Compost
                'insumos_agricolas_3.png', // Ejemplo genérico
            ],
            'Maquinaria agrícola' => [
                'maquinaria_agricola_1.png', // Ejemplo para Tractor
                'maquinaria_agricola_2.png', // Ejemplo para Fumigadora
            ],
            'Control de plagas' => [
                'control_plagas_1.png', // Ejemplo para Insecticida
                'control_plagas_2.png', // Ejemplo para Trampa
            ],
            'Producto Animal' => [
                'producto_animal_1.png', // Ejemplo para Alpaca
                'producto_animal_2.png', // Ejemplo para Llama
            ],
            'Alimentos para ganado' => [
                'alimentos_ganado_1.png', // Ejemplo para Heno
                'alimentos_ganado_2.png', // Ejemplo para Concentrado
            ],
            'Medicamentos veterinarios' => [
                'medicamentos_veterinarios_1.png', // Ejemplo para Suplemento
                'medicamentos_veterinarios_2.png', // Ejemplo para Vacuna
            ],
            'Herramientas agrícolas' => [
                'herramientas_agricolas_1.png', // Ejemplo para Pala
                'herramientas_agricolas_2.png', // Ejemplo para Tijera
            ],
            'Otros productos' => [
                'otros_productos_1.png', // Ejemplo genérico
                'otros_productos_2.png', // Otro genérico
            ],
        ];

        $baseProductsList = [
            'Semillas de Maíz Morado', 'Papa Nativa Amarilla', 'Quinua Orgánica Grano Entero', 'Tarwi Desamargado',
            'Habas Secas Selección', 'Cebada Perlada', 'Kiwicha Orgánica', 'Maca en Polvo Andina',
            'Fertilizante Orgánico Premium', 'Compost Enriquecido', 'Bioestimulante Natural', 'Substrato Universal',
            'Abono de Humus de Lombriz', 'Cal Agrícola Micronizada',
            'Tractor Agrícola Compacto', 'Arado de Disco Profesional', 'Sembradora Manual de Precisión',
            'Fumigadora de Mochila Motorizada', 'Motocultor Diesel',
            'Insecticida Orgánico Concentrado', 'Fungicida Biológico para Cultivos', 'Trampa Adhesiva para Insectos',
            'Repelente Natural de Roedores',
            'Suplemento Vitamínico Ganadero', 'Alpaca Joven (para crianza)', 'Llama de Carga', 'Cuy Mejorado para Carne',
            'Heno de Alfalfa Premium', 'Concentrado para Vacuno de Leche', 'Bloque Salino Mineral',
            'Antihelmíntico Oral Bovino', 'Vacuna Polivalente Ovina',
            'Kit de Herramientas de Jardín', 'Pala Forjada Reforzada', 'Rastrillo Metálico Ancho', 'Tijera de Poda Profesional',
            'Sistema de Riego por Goteo Básico', 'Manguera de Riego Reforzada', 'Guantes de Jardinería',
        ];

        $productCategoryMap = [
            'Semillas de Maíz Morado' => 'Productos agrícolas',
            'Papa Nativa Amarilla' => 'Productos agrícolas',
            'Quinua Orgánica Grano Entero' => 'Productos agrícolas',
            'Tarwi Desamargado' => 'Productos agrícolas',
            'Habas Secas Selección' => 'Productos agrícolas',
            'Cebada Perlada' => 'Productos agrícolas',
            'Kiwicha Orgánica' => 'Productos agrícolas',
            'Maca en Polvo Andina' => 'Productos agrícolas',

            'Fertilizante Orgánico Premium' => 'Insumos agrícolas',
            'Compost Enriquecido' => 'Insumos agrícolas',
            'Bioestimulante Natural' => 'Insumos agrícolas',
            'Substrato Universal' => 'Insumos agrícolas',
            'Abono de Humus de Lombriz' => 'Insumos agrícolas',
            'Cal Agrícola Micronizada' => 'Insumos agrícolas',

            'Tractor Agrícola Compacto' => 'Maquinaria agrícola',
            'Arado de Disco Profesional' => 'Maquinaria agrícola',
            'Sembradora Manual de Precisión' => 'Maquinaria agrícola',
            'Fumigadora de Mochila Motorizada' => 'Maquinaria agrícola',
            'Motocultor Diesel' => 'Maquinaria agrícola',

            'Insecticida Orgánico Concentrado' => 'Control de plagas',
            'Fungicida Biológico para Cultivos' => 'Control de plagas',
            'Trampa Adhesiva para Insectos' => 'Control de plagas',
            'Repelente Natural de Roedores' => 'Control de plagas',

            'Suplemento Vitamínico Ganadero' => 'Producto Animal',
            'Alpaca Joven (para crianza)' => 'Producto Animal',
            'Llama de Carga' => 'Producto Animal',
            'Cuy Mejorado para Carne' => 'Producto Animal',

            'Heno de Alfalfa Premium' => 'Alimentos para ganado',
            'Concentrado para Vacuno de Leche' => 'Alimentos para ganado',
            'Bloque Salino Mineral' => 'Alimentos para ganado',

            'Antihelmíntico Oral Bovino' => 'Medicamentos veterinarios',
            'Vacuna Polivalente Ovina' => 'Medicamentos veterinarios',

            'Kit de Herramientas de Jardín' => 'Herramientas agrícolas',
            'Pala Forjada Reforzada' => 'Herramientas agrícolas',
            'Rastrillo Metálico Ancho' => 'Herramientas agrícolas',
            'Tijera de Poda Profesional' => 'Herramientas agrícolas',

            'Sistema de Riego por Goteo Básico' => 'Otros productos',
            'Manguera de Riego Reforzada' => 'Otros productos',
            'Guantes de Jardinería' => 'Otros productos',
        ];

        for ($i = 0; $i < 30; $i++) {
            $randomProductName = $baseProductsList[array_rand($baseProductsList)];
            $category = $productCategoryMap[$randomProductName];

            $descriptionWords = [
                'excelente calidad', 'ideal para la producción', 'efectivo', 'duradero',
                'sostenible', 'innovador', 'orgánico certificado', 'alto rendimiento',
                'protege tus cultivos', 'mejora la salud animal', 'fácil de usar',
                'amigable con el medio ambiente', 'probado en campo', 'tecnología avanzada'
            ];
            $description = $randomProductName . ': ' . Str::limit(implode(' ', array_rand(array_flip($descriptionWords), rand(3, 5))) . ' para un óptimo desarrollo agropecuario.', 150, '...');

            $price = round(rand(1000, 15000) / 100, 2);
            $stock = rand(20, 300);

            // Obtener un nombre de archivo de imagen aleatorio para la categoría
            $image_filename = $imageFileNames[$category][array_rand($imageFileNames[$category])];
            $image_path = 'images/' . $image_filename; // Ruta relativa dentro de public

            Product::create([
                'name' => $randomProductName . ' v' . ($i + 1),
                'description' => $description,
                'price' => $price,
                'stock' => $stock,
                'image_path' => $image_path,
                'category' => $category
            ]);
        }
    }
}
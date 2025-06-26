<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str; // Aunque Str no se usa en esta versión, se mantiene por si acaso

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Desactiva la verificación de claves foráneas para permitir el truncado.
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        // Trunca la tabla 'products' para asegurar un estado limpio antes de sembrar.
        Product::truncate();
        // Vuelve a activar la verificación de claves foráneas.
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Productos agrícolas
        Product::create([
            'name' => 'Semillas de Maíz Morado',
            'description' => 'Semillas certificadas de maíz morado andino. Alto rendimiento y resistencia a plagas comunes.',
            'price' => 45.50,
            'stock' => 94,
            'image_path' => 'images/semillasmaizmorado.png',
            'category' => 'Productos agrícolas'
        ]);
        Product::create([
            'name' => 'Papa Nativa Amarilla',
            'description' => 'Papa nativa de los Andes, ideal para diversos platillos. Sabor y textura únicos.',
            'price' => 2.80,
            'stock' => 500,
            'image_path' => 'images/papaamarilla.png',
            'category' => 'Productos agrícolas'
        ]);
        Product::create([
            'name' => 'Quinua Orgánica Grano Entero',
            'description' => 'Quinua orgánica de grano entero, cultivada en Puno. Fuente de proteína y fibra.',
            'price' => 15.00,
            'stock' => 250,
            'image_path' => 'images/quinua.png',
            'category' => 'Productos agrícolas'
        ]);
        Product::create([
            'name' => 'Tarwi Desamargado',
            'description' => 'Tarwi desamargado listo para consumir. Legumbre andina de alto valor nutritivo.',
            'price' => 8.50,
            'stock' => 180,
            'image_path' => 'images/tarwi.png',
            'category' => 'Productos agrícolas'
        ]);
        Product::create([
            'name' => 'Habas Secas Selección',
            'description' => 'Habas secas seleccionadas, perfectas para guisos y sopas.',
            'price' => 6.20,
            'stock' => 300,
            'image_path' => 'images/habassecas.png',
            'category' => 'Productos agrícolas'
        ]);
        Product::create([
            'name' => 'Cebada Perlada',
            'description' => 'Cebada perlada de alta calidad, ideal para sopas y bebidas.',
            'price' => 4.90,
            'stock' => 220,
            'image_path' => 'images/cebada.png',
            'category' => 'Productos agrícolas'
        ]);
        Product::create([
            'name' => 'Kiwicha Orgánica',
            'description' => 'Kiwicha orgánica, un superalimento andino rico en calcio y hierro.',
            'price' => 12.00,
            'stock' => 150,
            'image_path' => 'images/kiwicha.png',
            'category' => 'Productos agrícolas'
        ]);
        Product::create([
            'name' => 'Maca en Polvo Andina',
            'description' => 'Polvo de maca pura de los Andes, energizante natural y adaptógeno.',
            'price' => 25.00,
            'stock' => 100,
            'image_path' => 'images/maca.png',
            'category' => 'Productos agrícolas'
        ]);

        // Insumos agrícolas
        Product::create([
            'name' => 'Fertilizante Orgánico Premium',
            'description' => 'Fertilizante 100% orgánico para cultivos. Enriquecido con minerales naturales.',
            'price' => 76.40,
            'stock' => 128,
            'image_path' => 'images/fertilizanteorganico.png',
            'category' => 'Insumos agrícolas'
        ]);
        Product::create([
            'name' => 'Compost Enriquecido',
            'description' => 'Compost de alta calidad para mejorar la estructura y fertilidad del suelo.',
            'price' => 30.00,
            'stock' => 180,
            'image_path' => 'images/compost.png',
            'category' => 'Insumos agrícolas'
        ]);
        Product::create([
            'name' => 'Bioestimulante Natural',
            'description' => 'Bioestimulante a base de algas para potenciar el crecimiento y desarrollo de plantas.',
            'price' => 95.00,
            'stock' => 90,
            'image_path' => 'images/bioestimulantenatural.png',
            'category' => 'Insumos agrícolas'
        ]);
        Product::create([
            'name' => 'Substrato Universal',
            'description' => 'Substrato para todo tipo de plantas, asegura un buen drenaje y aireación.',
            'price' => 20.00,
            'stock' => 250,
            'image_path' => 'images/substrato.png',
            'category' => 'Insumos agrícolas'
        ]);
        Product::create([
            'name' => 'Abono de Humus de Lombriz',
            'description' => 'Abono orgánico de humus de lombriz, ideal para nutrir y revitalizar el suelo.',
            'price' => 45.00,
            'stock' => 130,
            'image_path' => 'images/abonohumus.png',
            'category' => 'Insumos agrícolas'
        ]);
        Product::create([
            'name' => 'Cal Agrícola Micronizada',
            'description' => 'Cal micronizada para corregir la acidez del suelo y mejorar la absorción de nutrientes.',
            'price' => 55.00,
            'stock' => 110,
            'image_path' => 'images/micronizada.png',
            'category' => 'Insumos agrícolas'
        ]);

        // Maquinaria agrícola
        Product::create([
            'name' => 'Tractor Agrícola Compacto',
            'description' => 'Tractor agrícola de tamaño compacto, ideal para pequeñas y medianas extensiones.',
            'price' => 25000.00,
            'stock' => 5,
            'image_path' => 'images/tractor.png',
            'category' => 'Maquinaria agrícola'
        ]);
        Product::create([
            'name' => 'Arado de Disco Profesional',
            'description' => 'Arado de disco robusto para preparación de suelos, compatible con diversos tractores.',
            'price' => 8500.00,
            'stock' => 8,
            'image_path' => 'images/arado.png',
            'category' => 'Maquinaria agrícola'
        ]);
        Product::create([
            'name' => 'Sembradora Manual de Precisión',
            'description' => 'Sembradora manual para siembra de precisión de pequeñas semillas.',
            'price' => 450.00,
            'stock' => 30,
            'image_path' => 'images/sembradora.png',
            'category' => 'Maquinaria agrícola'
        ]);
        Product::create([
            'name' => 'Fumigadora de Mochila Motorizada',
            'description' => 'Fumigadora potente y cómoda, ideal para la aplicación de fitosanitarios.',
            'price' => 780.00,
            'stock' => 25,
            'image_path' => 'images/fumigadora.png',
            'category' => 'Maquinaria agrícola'
        ]);
        Product::create([
            'name' => 'Motocultor Diesel',
            'description' => 'Motocultor diésel de alto rendimiento para labores de arado y siembra.',
            'price' => 4200.00,
            'stock' => 10,
            'image_path' => 'images/motocultor.png',
            'category' => 'Maquinaria agrícola'
        ]);

        // Control de plagas
        Product::create([
            'name' => 'Insecticida Orgánico Concentrado',
            'description' => 'Insecticida orgánico de amplio espectro, seguro para cultivos y el medio ambiente.',
            'price' => 65.00,
            'stock' => 110,
            'image_path' => 'images/insecticida.png',
            'category' => 'Control de plagas'
        ]);
        Product::create([
            'name' => 'Fungicida Biológico para Cultivos',
            'description' => 'Fungicida biológico que protege tus cultivos de diversas enfermedades fúngicas.',
            'price' => 80.00,
            'stock' => 90,
            'image_path' => 'images/fungicida.png',
            'category' => 'Control de plagas'
        ]);
        Product::create([
            'name' => 'Trampa Adhesiva para Insectos',
            'description' => 'Trampas adhesivas para el monitoreo y control de insectos voladores en invernaderos.',
            'price' => 25.00,
            'stock' => 150,
            'image_path' => 'images/trampa.png',
            'category' => 'Control de plagas'
        ]);
        Product::create([
            'name' => 'Repelente Natural de Roedores',
            'description' => 'Repelente natural a base de extractos vegetales para ahuyentar roedores de almacenes y cultivos.',
            'price' => 50.00,
            'stock' => 70,
            'image_path' => 'images/repelente.png',
            'category' => 'Control de plagas'
        ]);

        // Producto Animal
        Product::create([
            'name' => 'Suplemento Vitamínico Ganadero',
            'description' => 'Suplemento vitamínico mineral para bovinos, mejora la salud y productividad.',
            'price' => 120.00,
            'stock' => 152,
            'image_path' => 'images/suplemento.png',
            'category' => 'Producto Animal'
        ]);
        Product::create([
            'name' => 'Alpaca Joven (para crianza)',
            'description' => 'Alpaca joven de alta genética, ideal para inicio o expansión de rebaños.',
            'price' => 800.00,
            'stock' => 10,
            'image_path' => 'images/alpaca.png',
            'category' => 'Producto Animal'
        ]);
        Product::create([
            'name' => 'Llama de Carga',
            'description' => 'Llama adulta entrenada para carga, resistente y adaptable a terrenos difíciles.',
            'price' => 600.00,
            'stock' => 7,
            'image_path' => 'images/llama.png',
            'category' => 'Producto Animal'
        ]);
        Product::create([
            'name' => 'Cuy Mejorado para Carne',
            'description' => 'Cuy de raza mejorada para producción de carne, alto crecimiento y rendimiento.',
            'price' => 35.00,
            'stock' => 40,
            'image_path' => 'images/cuy.png',
            'category' => 'Producto Animal'
        ]);

        // Alimentos para ganado
        Product::create([
            'name' => 'Heno de Alfalfa Premium',
            'description' => 'Heno de alfalfa de primera calidad, fuente de fibra y nutrientes para rumiantes.',
            'price' => 0.80,
            'stock' => 500,
            'image_path' => 'images/alfalfa.png',
            'category' => 'Alimentos para ganado'
        ]);
        Product::create([
            'name' => 'Concentrado para Vacuno de Leche',
            'description' => 'Concentrado balanceado para vacas lecheras, optimiza la producción y calidad de la leche.',
            'price' => 150.00,
            'stock' => 80,
            'image_path' => 'images/vacuno.png',
            'category' => 'Alimentos para ganado'
        ]);
        Product::create([
            'name' => 'Bloque Salino Mineral',
            'description' => 'Bloque de sal mineralizada para ganado, previene deficiencias nutricionales.',
            'price' => 25.00,
            'stock' => 200,
            'image_path' => 'images/salinomineral.png',
            'category' => 'Alimentos para ganado'
        ]);

        // Medicamentos veterinarios
        Product::create([
            'name' => 'Antihelmíntico Oral Bovino',
            'description' => 'Desparasitante oral de amplio espectro para ganado bovino.',
            'price' => 75.00,
            'stock' => 60,
            'image_path' => 'images/antihelmintico.png',
            'category' => 'Medicamentos veterinarios'
        ]);
        Product::create([
            'name' => 'Vacuna Polivalente Ovina',
            'description' => 'Vacuna polivalente para la prevención de enfermedades comunes en ovinos.',
            'price' => 110.00,
            'stock' => 40,
            'image_path' => 'images/vacunapolivalente.png',
            'category' => 'Medicamentos veterinarios'
        ]);

        // Herramientas agrícolas
        Product::create([
            'name' => 'Kit de Herramientas de Jardín',
            'description' => 'Set completo de herramientas para agricultura urbana y de jardín.',
            'price' => 89.90,
            'stock' => 87,
            'image_path' => 'images/herramienta.png',
            'category' => 'Herramientas agrícolas'
        ]);
        Product::create([
            'name' => 'Pala Forjada Reforzada',
            'description' => 'Pala de alta resistencia para trabajos pesados en el campo.',
            'price' => 45.00,
            'stock' => 100,
            'image_path' => 'images/pala.png',
            'category' => 'Herramientas agrícolas'
        ]);
        Product::create([
            'name' => 'Rastrillo Metálico Ancho',
            'description' => 'Rastrillo metálico de gran tamaño para limpieza y nivelación de terrenos.',
            'price' => 30.00,
            'stock' => 120,
            'image_path' => 'images/rastrillo.png',
            'category' => 'Herramientas agrícolas'
        ]);
        Product::create([
            'name' => 'Tijera de Poda Profesional',
            'description' => 'Tijera de poda de alta precisión para frutales y arbustos.',
            'price' => 60.00,
            'stock' => 75,
            'image_path' => 'images/tijerapoda.png',
            'category' => 'Herramientas agrícolas'
        ]);

        // Otros productos
        Product::create([
            'name' => 'Sistema de Riego por Goteo Básico',
            'description' => 'Sistema básico de riego por goteo con temporizador, ideal para pequeños huertos.',
            'price' => 235.00,
            'stock' => 76,
            'image_path' => 'images/riegobasico.png',
            'category' => 'Otros productos'
        ]);
        Product::create([
            'name' => 'Manguera de Riego Reforzada',
            'description' => 'Manguera de riego de alta durabilidad y resistencia a la intemperie.',
            'price' => 90.00,
            'stock' => 90,
            'image_path' => 'images/manguera.png',
            'category' => 'Otros productos'
        ]);
        Product::create([
            'name' => 'Guantes de Jardinería',
            'description' => 'Guantes resistentes para protección en trabajos de jardinería y agricultura.',
            'price' => 20.00,
            'stock' => 180,
            'image_path' => 'images/guantes.png',
            'category' => 'Otros productos'
        ]);
    }
}
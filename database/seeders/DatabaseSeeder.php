<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Product;
use App\Models\Cart;
use App\Models\CartItem;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Desactivar las comprobaciones de claves foráneas
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');

        // 2. Truncar las tablas en el ORDEN CORRECTO (primero las que tienen claves foráneas, luego las referenciadas)
        CartItem::truncate(); // Truncar ítems del carrito primero, ya que dependen de carts y products
        Cart::truncate();     // Truncar carritos, ya que dependen de users
        Product::truncate();  // Truncar productos (si tu ProductSeeder no lo hace, o si quieres asegurarte)
        User::truncate();     // Truncar usuarios al final, ya que otras tablas dependen de esta

        User::factory()->create([
            'name' => 'Edy Jair Tola Quispe',
            'email' => 'jaircitola@gmail.com',
            'password' => bcrypt('12345678'),
            'role' => 'administrador',
        ]);

        User::factory()->create([
            'name' => 'Cliente',
            'email' => 'cliente@gmail.com',
            'password' => bcrypt('1234567890'),
            'role' => 'cliente',
        ]);


        $this->call([
            ProductSeeder::class, 
            // Este seeder ya contiene su propio truncate de Product, pero tenerlo al inicio es más seguro
            
            // CategorySeeder::class,
        ]);

        // 5. Reactivar las comprobaciones de claves foráneas
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
    }
}
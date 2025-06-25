<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cart_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cart_id')->constrained('carts')->onDelete('cascade');
            // cart_id es una clave foránea a la tabla 'carts'.
            // onDelete('cascade') elimina el item del carrito si el carrito se elimina.
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade');
            // product_id es una clave foránea a la tabla 'products'.
            // onDelete('cascade') elimina el item del carrito si el producto se elimina.
            $table->integer('quantity');
            $table->decimal('price_at_purchase', 10, 2); // Precio del producto en el momento de añadirlo al carrito
            $table->timestamps();

            // Opcional: Para evitar duplicados de un mismo producto en un mismo carrito
            $table->unique(['cart_id', 'product_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cart_items');
    }
};

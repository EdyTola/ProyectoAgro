<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\CartItem; // Asegúrate de importar CartItem

class ShoppingCart extends Component
{
    public $cart; // Almacenará el objeto del carrito
    public $cartItems; // Almacenará los ítems del carrito
    public $total = 0; // Almacenará el total del carrito

    // Listener para el evento 'cart-updated'
    protected $listeners = ['cart-updated' => 'mount'];

    public function mount()
    {
        if (Auth::check()) {
            // Obtener el carrito del usuario, si no existe, se crea uno vacío (o se redirige, dependiendo de tu lógica)
            $this->cart = Auth::user()->cart()->with('cartItems.product')->firstOrCreate([]);
            $this->cartItems = $this->cart->cartItems;
            $this->calculateTotal();
        } else {
            $this->cart = null;
            $this->cartItems = collect(); // Colección vacía si no hay usuario o carrito
            $this->total = 0;
        }
    }

    public function calculateTotal()
    {
        $this->total = 0;
        foreach ($this->cartItems as $item) {
            $this->total += $item->quantity * $item->price_at_purchase;
        }
    }

    public function render()
    {
        return view('livewire.shopping-cart');
    }
}
<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\CartItem; // Asegúrate de importar CartItem
use App\Models\Product; // También es bueno importar Product si lo usas en el futuro, aunque no directamente aquí

class ShoppingCart extends Component
{
    public $cart; // Almacenará el objeto del carrito
    public $cartItems; // Almacenará los ítems del carrito
    public $total = 0; // Almacenará el total del carrito

    // Listener para el evento 'cart-updated'
    protected $listeners = ['cartUpdated' => 'mount']; // Cambié a 'cartUpdated' para consistencia con el dispatch

    public function mount()
    {
        if (Auth::check()) {
            // Obtener el carrito del usuario, si no existe, se crea uno
            // Con with('cartItems.product'), carga los ítems del carrito y sus productos relacionados
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

    /**
     * Elimina un ítem específico del carrito del usuario autenticado.
     * @param int $itemId El ID del CartItem a eliminar.
     */
    public function removeItem($itemId)
    {
        // Asegúrate de que el usuario está autenticado y el ítem le pertenece
        if (Auth::check()) {
            CartItem::where('id', $itemId)
                    ->whereHas('cart', function ($query) {
                        $query->where('user_id', Auth::id());
                    })
                    ->delete();

            $this->mount(); // Recargar el carrito para actualizar la vista
            $this->dispatch('cartUpdated'); // Emitir evento para otros componentes si es necesario
        }
    }

    /**
     * Incrementa la cantidad de un ítem específico en el carrito.
     * @param int $itemId El ID del CartItem a actualizar.
     */
    public function incrementQuantity($itemId)
    {
        if (Auth::check()) {
            $item = CartItem::where('id', $itemId)
                            ->whereHas('cart', function ($query) {
                                $query->where('user_id', Auth::id());
                            })
                            ->first();

            if ($item) {
                // Opcional: Puedes añadir una comprobación de stock aquí si lo deseas
                // $product = Product::find($item->product_id);
                // if ($item->quantity < $product->stock) { ... }

                $item->quantity++;
                $item->save();
                $this->mount(); // Recargar el carrito para actualizar la vista
                $this->dispatch('cartUpdated');
            }
        }
    }

    /**
     * Decrementa la cantidad de un ítem específico en el carrito. Si la cantidad llega a 0, elimina el ítem.
     * @param int $itemId El ID del CartItem a actualizar.
     */
    public function decrementQuantity($itemId)
    {
        if (Auth::check()) {
            $item = CartItem::where('id', $itemId)
                            ->whereHas('cart', function ($query) {
                                $query->where('user_id', Auth::id());
                            })
                            ->first();

            if ($item) {
                if ($item->quantity > 1) {
                    $item->quantity--;
                    $item->save();
                } else {
                    // Si la cantidad es 1 y se intenta decrementar, elimina el ítem
                    $item->delete();
                }
                $this->mount(); // Recargar el carrito para actualizar la vista
                $this->dispatch('cartUpdated');
            }
        }
    }

    public function render()
    {
        return view('livewire.shopping-cart');
    }
}
<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Cart;
use App\Models\CartItem;

class AddToCartButton extends Component
{
    public Product $product;
    public int $quantity = 1;
    public bool $itemAdded = false; // Para mostrar un mensaje de confirmación

    // Las reglas de validación para la cantidad
    protected function rules()
    {
        return [
            'quantity' => 'required|integer|min:1|max:' . $this->product->stock,
        ];
    }

    public function addToCart()
    {
        $this->validate();

        if (!Auth::check()) {
            session()->flash('error', 'Por favor, inicia sesión para añadir productos al carrito.');
            $this->redirect(route('login'));
            return;
        }

        $cart = Auth::user()->cart()->firstOrCreate([]);

        $cartItem = $cart->cartItems()->where('product_id', $this->product->id)->first();

        if ($cartItem) {
            $newQuantity = $cartItem->quantity + $this->quantity;
            if ($newQuantity > $this->product->stock) {
                session()->flash('error', 'No hay suficiente stock para añadir más de este producto (disponible: ' . ($this->product->stock - $cartItem->quantity) . ').');
                return;
            }
            $cartItem->update(['quantity' => $newQuantity]);
        } else {
            CartItem::create([
                'cart_id' => $cart->id,
                'product_id' => $this->product->id,
                'quantity' => $this->quantity,
                'price_at_purchase' => $this->product->price,
            ]);
        }

        $this->dispatch('cart-updated'); // Evento para actualizar el contador del carrito
        session()->flash('success', 'Producto añadido al carrito correctamente.');
        $this->reset('quantity'); // Resetear la cantidad a 1

        // --- CAMBIO AQUÍ: QUITAR EL DELAY DE JS Y HACERLO VIA PHP/LIVEWIRE ---
        // Puedes usar una propiedad temporal o un dispatch para controlar el mensaje
        // Para que el mensaje de éxito desaparezca, lo controlaremos en la vista
        // o con un dispatch que lo oculte. Por ahora, el flash session lo gestiona.
        // La línea problemática era: $this->js('$wire.itemAdded = false;')->delay(3000);
        // La propiedad $itemAdded se usa con wire:model, no es necesaria para el mensaje flash
        // que es temporal. Si quieres que el mensaje de éxito se quede por un tiempo fijo:
        // return $this->redirect(url()->previous(), navigate:true); // Opcional, recarga la página.

        // Si quieres un mensaje que desaparezca después de un tiempo sin recargar:
        // Podrías usar un JavaScript global o una propiedad temporizada de Livewire.
        // Para simplificar, confiaremos en que el mensaje flash desaparezca con la próxima petición.
        // O, si realmente quieres un delay controlado por Livewire:
        // $this->dispatch('show-success-message')->self(); // Dispatch an event to yourself
        // sleep(3); // Pausar la ejecución por 3 segundos (NO RECOMENDADO EN PRODUCCIÓN)
        // $this->dispatch('hide-success-message')->self(); // Then hide it

        // LA FORMA MÁS SENCILLA PARA MENSAJES TEMPORALES EN LIVEWIRE ES CON JAVASCRIPT DIRECTO O PROPIEDADES TIMED
        // O una forma más moderna para messages flash con Volt:
        // session()->flash('success', 'Producto añadido al carrito correctamente.');
        // Puedes tener un JS global que detecte esto y lo oculte.
        // Por ahora, simplemente confiamos en el `session()->flash`
    }

    public function render()
    {
        return view('livewire.add-to-cart-button');
    }
}
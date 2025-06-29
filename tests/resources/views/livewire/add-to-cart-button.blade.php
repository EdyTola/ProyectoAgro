<div class="flex flex-col items-center">
    @if (session()->has('success'))
        <div class="text-green-600 dark:text-green-400 text-sm mb-2 text-center">
            {{ session('success') }}
        </div>
    @endif
    @if (session()->has('error'))
        <div class="text-red-600 dark:text-red-400 text-sm mb-2 text-center">
            {{ session('error') }}
        </div>
    @endif

    <div class="flex items-center space-x-2 mb-2">
        <label for="quantity-{{ $product->id }}" class="text-sm text-gray-700 dark:text-gray-300">Cantidad:</label>
        <input
            type="number"
            id="quantity-{{ $product->id }}"
            wire:model.live="quantity"
            min="1"
            max="{{ $product->stock }}"
            class="w-20 p-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm text-center text-gray-900 dark:text-gray-100 dark:bg-gray-700 focus:ring-indigo-500 focus:border-indigo-500"
        >
    </div>
    @error('quantity') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror

    <button
        wire:click="addToCart"
        wire:loading.attr="disabled"
        wire:target="addToCart"
        class="w-full bg-[#8B805C] hover:bg-[#7a704e] text-white py-2 rounded-md font-semibold disabled:opacity-50 disabled:cursor-not-allowed"
    >
        <span wire:loading.remove wire:target="addToCart">Añadir al Carrito</span>
        <span wire:loading wire:target="addToCart">Añadiendo...</span>
    </button>
</div>
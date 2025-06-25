<div class="container mx-auto p-6 bg-[#FDFDFC] dark:bg-[#0a0a0a] min-h-screen">
    <h1 class="text-4xl font-bold text-center text-gray-800 dark:text-gray-200 mb-8">Tu Carrito de Compras</h1>

    @if ($cartItems->isEmpty())
        <div class="text-center py-10">
            <p class="text-xl text-gray-600 dark:text-gray-400">Tu carrito está vacío. ¡Es hora de llenarlo con productos increíbles!</p>
            <a href="{{ route('catalogo') }}" class="mt-6 inline-block bg-[#8B805C] hover:bg-[#7a704e] text-white font-bold py-3 px-6 rounded-lg transition duration-300">
                Ir al Catálogo
            </a>
        </div>
    @else
        <div class="lg:flex lg:space-x-8">
            <div class="lg:w-2/3 bg-white dark:bg-gray-800 rounded-lg shadow-xl p-6 mb-8 lg:mb-0">
                <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-200 mb-6 border-b pb-4">Productos en tu Carrito</h2>
                @foreach ($cartItems as $item)
                    <div class="flex items-center border-b border-gray-200 dark:border-gray-700 py-4 last:border-b-0">
                        <div class="w-24 h-24 flex-shrink-0">
                            <img src="{{ asset($item->product->image_path ?: 'images/default-product.png') }}" alt="{{ $item->product->name }}" class="w-full h-full object-cover rounded-md">
                        </div>
                        <div class="flex-grow ml-4">
                            <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">{{ $item->product->name }}</h3>
                            <p class="text-gray-600 dark:text-gray-400 text-sm">{{ Str::limit($item->product->description, 50) }}</p>
                            <p class="text-lg font-bold text-[#8B805C] dark:text-[#a59a7c] mt-1">S/ {{ number_format($item->price_at_purchase, 2) }}</p>
                        </div>
                        <div class="flex items-center space-x-4">
                            <span class="text-gray-700 dark:text-gray-300">Cantidad: {{ $item->quantity }}</span>
                            <span class="text-lg font-semibold text-gray-900 dark:text-gray-100">S/ {{ number_format($item->quantity * $item->price_at_purchase, 2) }}</span>
                            {{-- Aquí podrías añadir botones para aumentar/disminuir cantidad o eliminar --}}
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="lg:w-1/3 bg-white dark:bg-gray-800 rounded-lg shadow-xl p-6 h-fit sticky top-6">
                <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-200 mb-6 border-b pb-4">Resumen del Pedido</h2>
                <div class="space-y-4 text-lg">
                    <div class="flex justify-between items-center text-gray-700 dark:text-gray-300">
                        <span>Subtotal ({{ $cartItems->sum('quantity') }} productos):</span>
                        <span>S/ {{ number_format($total, 2) }}</span>
                    </div>
                    <div class="flex justify-between items-center text-gray-700 dark:text-gray-300">
                        <span>Envío:</span>
                        <span>A calcular</span>
                    </div>
                    <div class="flex justify-between items-center text-xl font-bold text-gray-900 dark:text-gray-100 border-t pt-4 mt-4">
                        <span>Total Estimado:</span>
                        <span>S/ {{ number_format($total, 2) }}</span>
                    </div>
                </div>
                <button class="mt-8 w-full bg-[#8B805C] hover:bg-[#7a704e] text-white font-bold py-3 px-6 rounded-lg transition duration-300">
                    Proceder al Pago
                </button>
                <a href="{{ route('catalogo') }}" class="mt-4 w-full inline-block text-center text-[#8B805C] hover:text-[#7a704e] font-semibold py-2 px-4 rounded-lg transition duration-300 border border-[#8B805C] dark:border-gray-700">
                    Seguir Comprando
                </a>
            </div>
        </div>
    @endif
</div>
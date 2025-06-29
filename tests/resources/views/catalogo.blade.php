<x-layouts.app :title="__('Catálogo')">
    <div class="p-6 bg-[#FDFDFC] dark:bg-[#0a0a0a] min-h-screen">
        <h1 class="text-4xl font-bold text-gray-800 dark:text-gray-200 mb-8 text-center">Catálogo de Productos</h1>
        <p class="text-center text-gray-600 dark:text-gray-400 mb-8">Encuentra los mejores productos agropecuarios para tu negocio.</p>

        <form action="{{ route('catalogo') }}" method="GET" class="mb-10 max-w-4xl mx-auto flex flex-wrap items-center justify-center md:justify-between gap-4 p-4 bg-white dark:bg-gray-800 rounded-lg shadow-md">
            <div class="flex-grow">
                <label for="search" class="sr-only">Buscar productos agropecuarios...</label>
                <input type="text" name="search" id="search" placeholder="Buscar productos agropecuarios..."
                        value="{{ $searchTerm }}"
                        class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-[#8B805C] focus:border-[#8B805C] dark:bg-gray-700 dark:text-gray-200">
            </div>

            <div>
                <label for="category" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Filtrar por:</label>
                <select name="category" id="category"
                        class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-[#8B805C] focus:border-[#8B805C] sm:text-sm rounded-md dark:bg-gray-700 dark:text-gray-200 dark:border-gray-600">
                    <option value="Todos los productos" {{ $filterCategory === 'Todos los productos' ? 'selected' : '' }}>Todos los productos</option>
                    @foreach ($orderedCategories as $cat)
                        <option value="{{ $cat }}" {{ $filterCategory === $cat ? 'selected' : '' }}>{{ $cat }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="order_by" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Ordenar por:</label>
                <select name="order_by" id="order_by"
                        class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-[#8B805C] focus:border-[#8B805C] sm:text-sm rounded-md dark:bg-gray-700 dark:text-gray-200 dark:border-gray-600">
                    <option value="name" {{ $orderBy === 'name' ? 'selected' : '' }}>Nombre</option>
                    <option value="price" {{ $orderBy === 'price' ? 'selected' : '' }}>Precio</option>
                    <option value="created_at" {{ $orderBy === 'created_at' ? 'selected' : '' }}>Más reciente</option>
                </select>
            </div>

            <div>
                <label for="order_direction" class="block text-sm font-medium text-gray-700 dark:text-gray-300 sr-only">Dirección</label>
                <select name="order_direction" id="order_direction"
                        class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-[#8B805C] focus:border-[#8B805C] sm:text-sm rounded-md dark:bg-gray-700 dark:text-gray-200 dark:border-gray-600">
                    <option value="asc" {{ $orderDirection === 'asc' ? 'selected' : '' }}>Ascendente</option>
                    <option value="desc" {{ $orderDirection === 'desc' ? 'selected' : '' }}>Descendente</option>
                </select>
            </div>

            <button type="submit" class="px-6 py-2 bg-[#8B805C] text-white rounded-md hover:bg-[#7a704e] transition duration-300 mt-4 md:mt-0">
                Aplicar
            </button>
        </form>

        @php
            $hasProducts = false;
            foreach ($orderedCategories as $categoria) {
                if (!empty($groupedProducts[$categoria])) {
                    $hasProducts = true;
                    break;
                }
            }
        @endphp

        @if ($hasProducts)
            @foreach ($orderedCategories as $categoria)
                @if (!empty($groupedProducts[$categoria]))
                    <section class="mb-12 max-w-6xl mx-auto">
                        <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-200 mb-4 border-b pb-2 border-gray-200 dark:border-gray-700">{{ $categoria }}</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                            @foreach ($groupedProducts[$categoria] as $product)
                                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden flex flex-col">
                                    <img src="{{ asset($product->image_path ?: 'images/default-product.png') }}" alt="{{ $product->name }}" class="w-full h-48 object-cover">
                                    <div class="p-4 flex-grow flex flex-col justify-between">
                                        <div>
                                            <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-1">{{ $product->name }}</h3>
                                            <p class="text-gray-600 dark:text-gray-400 text-sm mb-3">{{ Str::limit($product->description, 70) }}</p>
                                        </div>
                                        <div>
                                            <div class="flex justify-between items-center mt-2">
                                                <span class="text-xl font-bold text-[#8B805C] dark:text-[#a59a7c]">S/ {{ number_format($product->price, 2) }}</span>
                                                {{-- Aquí es donde se reemplaza el botón estático por el componente Livewire AddToCartButton --}}
                                                {{-- Removimos el botón estático y lo reemplazamos con la inclusión de Livewire --}}
                                                {{-- <button class="px-3 py-1 bg-[#8B805C] text-white rounded-md text-sm hover:bg-[#7a704e] transition duration-300">
                                                    Agregar
                                                </button> --}}
                                            </div>
                                            @if ($product->stock < 10 && $product->stock > 0)
                                                <p class="text-xs text-yellow-600 dark:text-yellow-400 mt-1">¡Pocas unidades! ({{ $product->stock }} en stock)</p>
                                            @elseif ($product->stock == 0)
                                                <p class="text-xs text-red-600 dark:text-red-400 mt-1">Agotado</p>
                                            @endif
                                            {{-- Componente Livewire AddToCartButton --}}
                                            {{-- Asegúrate de que este div no esté dentro del div de precio y stock --}}
                                            <div class="mt-3"> {{-- Agregado mt-3 para un poco de espacio --}}
                                                @livewire('add-to-cart-button', ['product' => $product], key($product->id))
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </section>
                @endif
            @endforeach
        @else
            <p class="text-center text-gray-700 dark:text-gray-300 mt-10">No se encontraron productos que coincidan con tu búsqueda o filtros.</p>
        @endif

        {{-- Sección: ¿Necesitas ayuda con tu compra? (Solo con "Enviar mensaje") --}}
        <section class="mt-12 mb-12 max-w-4xl mx-auto p-6 bg-white dark:bg-gray-800 rounded-lg shadow-md text-center">
            <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-200 mb-4">¿Necesitas ayuda con tu compra?</h2>
            <p class="text-gray-600 dark:text-gray-400 mb-6">Nuestros asesores están disponibles para ayudarte a elegir los productos adecuados para tu negocio agrícola.</p>
            <div class="flex justify-center">
                <a href="{{ route('contactos') }}" class="px-6 py-3 border border-[#8B805C] text-[#8B805C] rounded-md hover:bg-[#8B805C] hover:text-white transition duration-300 flex items-center justify-center">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path><path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path></svg>
                    Enviar mensaje
                </a>
            </div>
        </section>

    </div>
</x-layouts.app>
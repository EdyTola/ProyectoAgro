<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Catálogo - Riccharly Huami Agropecuaria</title>

    <link rel="icon" href="/favicon.ico" sizes="any">
    <link rel="icon" href="/favicon.svg" type="image/svg+xml">
    <link rel="apple-touch-icon" href="/apple-touch-icon.png">

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <!-- Carga los estilos de Tailwind CSS y tus estilos personalizados a través de Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Enlace a Font Awesome para los iconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" xintegrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        /* Estilos personalizados para las secciones de tarjeta */
        .seccion-tarjeta-estilo {
            background-color: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        /* Ajustes para modo oscuro para las tarjetas */
        .dark .seccion-tarjeta-estilo {
            background-color: #1f2937; /* Un gris oscuro para el modo oscuro */
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.4);
        }

        /* Estilo para las tarjetas individuales de testimonios, equipo, productos, FAQ */
        .tarjeta-testimonio-estilo, .tarjeta-producto-estilo, .tarjeta-faq-estilo {
            background-color: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        .dark .tarjeta-testimonio-estilo, .dark .tarjeta-producto-estilo, .dark .tarjeta-faq-estilo {
            background-color: #1f2937;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.4);
        }

        /* Estilos para el layout general (sidebar y contenido) */
        .main-layout {
            display: flex;
            min-height: 100vh;
            background-color: #FDFDFC; /* Fondo claro */
            color: #333; /* Color de texto principal */
            padding-top: 64px; /* Espacio para la navbar fija */
            flex-direction: row; /* Sidebar a la izquierda */
        }

        .dark .main-layout {
            background-color: #0a0a0a; /* Fondo oscuro */
            color: #EDEDEC; /* Texto claro */
        }

        .sidebar {
            width: 250px; /* Ancho fijo del sidebar */
            background-color: #f8f8f8; /* Fondo claro del sidebar */
            border-right: 1px solid #e0e0e0; /* Borde separador a la derecha del sidebar */
            flex-shrink: 0; /* Evita que el sidebar se encoja */
            position: fixed; /* Fija el sidebar */
            height: calc(100vh - 64px); /* Ocupa toda la altura de la ventana menos la navbar */
            overflow-y: auto; /* Permite scroll si el contenido es largo */
            left: 0; /* Posiciona el sidebar a la izquierda */
            top: 64px; /* Alinea con la navbar */
        }

        .dark .sidebar {
            background-color: #1a1a1a; /* Fondo oscuro del sidebar */
            border-right-color: #333; /* Color del borde en modo oscuro */
        }

        .content-area {
            flex-grow: 1; /* Ocupa el espacio restante */
            margin-left: 250px; /* Margen para compensar el sidebar en el lado izquierdo */
            padding: 1.5rem; /* Padding para el contenido */
        }

        /* Ocultar sidebar en pantallas pequeñas (ej. móviles) */
        @media (max-width: 768px) {
            .sidebar {
                display: none;
            }
            .content-area {
                margin-left: 0; /* No hay margen si el sidebar está oculto */
            }
            .main-layout {
                flex-direction: column; /* En móviles, el contenido va debajo de la navbar */
            }
        }
    </style>
</head>
<body class="font-sans antialiased">
    {{-- Barra de Navegación Superior (Navbar) --}}
    <nav class="w-full bg-[#837227] dark:bg-[#7a704e] p-4 flex justify-between items-center shadow-md fixed top-0 left-0 z-50">
        <div class="flex items-center gap-4">
            {{-- Logo Riccharly Huami --}}
            <img src="{{ asset('images/logo-riccharly.png') }}" alt="Riccharly Huami Logo" class="h-8 w-auto">
            <span class="text-white text-lg font-semibold">Riccharly Huami</span>
        </div>
        {{-- Autenticación y Registro --}}
        @if (Route::has('login'))
            <div class="flex items-center gap-4">
                @auth
                    {{-- Avatar/Inicial del usuario --}}
                    <div class="flex items-center text-white no-underline cursor-default">
                        <div class="w-8 h-8 rounded-full bg-white flex items-center justify-center text-[#8B805C] text-base font-bold uppercase mr-2 shadow-sm">
                            {{ Auth::user()->initials() ?? substr(Auth::user()->name, 0, 1) }}
                        </div>
                        <span class="text-base font-medium">
                            {{ Auth::user()->name }}
                        </span>
                    </div>

                    {{-- Formulario para Cerrar Sesión --}}
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="inline-block px-5 py-1.5 text-white border border-white rounded-sm text-sm leading-normal ml-4
                                                bg-[#8B805C] hover:bg-[#7a704e] active:scale-95 transition duration-150 ease-in-out">
                            Cerrar Sesión
                        </button>
                    </form>
                @else
                    <a
                        href="{{ route('login') }}"
                        class="inline-block px-5 py-1.5 text-white border border-transparent hover:border-gray-200 rounded-sm text-sm leading-normal"
                    >
                        Iniciar Sesión
                    </a>

                    @if (Route::has('register'))
                        <a
                            href="{{ route('register') }}"
                            class="inline-block px-5 py-1.5 text-white border border-white hover:border-gray-200 rounded-sm text-sm leading-normal">
                            Registrarse
                        </a>
                    @endif
                @endauth
            </div>
        @endif
    </nav>

    {{-- Contenedor principal del layout: Sidebar + Contenido --}}
    <div class="main-layout">
        {{-- Barra Lateral (Sidebar) --}}
        <aside class="sidebar">
            <nav class="p-4">
                <ul class="space-y-2 font-medium">
                    @auth
                        {{-- Enlaces para usuarios autenticados (clientes y administradores por ahora) --}}
                        <x-flux::navlist.item href="{{ route('dashboard') }}" :current="request()->routeIs('dashboard')" wire:navigate class="text-[#1b1b18] dark:text-white">
                            <i class="fas fa-home mr-2 text-[#837227] dark:text-gray-400"></i> {{ __('Inicio') }}
                        </x-flux::navlist.item>

                        <x-flux::navlist.item href="{{ route('nosotros') }}" :current="request()->routeIs('nosotros')" wire:navigate class="text-[#1b1b18] dark:text-white">
                            <i class="fas fa-users mr-2 text-[#837227] dark:text-gray-400"></i> {{ __('Nosotros') }}
                        </x-flux::navlist.item>

                        <x-flux::navlist.item href="{{ route('catalogo') }}" :current="request()->routeIs('catalogo')" wire:navigate class="text-[#1b1b18] dark:text-white">
                            <i class="fas fa-book-open mr-2 text-[#837227] dark:text-gray-400"></i> {{ __('Catálogo') }}
                        </x-flux::navlist.item>

                        <x-flux::navlist.item href="{{ route('cart.index') }}" :current="request()->routeIs('cart.index')" wire:navigate class="text-[#1b1b18] dark:text-white">
                            <i class="fas fa-shopping-cart mr-2 text-[#837227] dark:text-gray-400"></i> {{ __('Carrito') }}
                        </x-flux::navlist.item>

                        <x-flux::navlist.item href="{{ route('contactos') }}" :current="request()->routeIs('contactos')" wire:navigate class="text-[#1b1b18] dark:text-white">
                            <i class="fas fa-envelope mr-2 text-[#837227] dark:text-gray-400"></i> {{ __('Contactos') }}
                        </x-flux::navlist.item>

                        <x-flux::navlist.item href="{{ route('boleta') ?? '#' }}" :current="request()->routeIs('boleta')" wire:navigate class="text-[#1b1b18] dark:text-white">
                            <i class="fas fa-file-invoice mr-2 text-[#837227] dark:text-gray-400"></i> {{ __('Boleta') }}
                        </x-flux::navlist.item>
                    @endauth

                    @guest
                        <x-flux::navlist.item href="{{ route('login') }}" :current="request()->routeIs('login')" wire:navigate class="text-[#1b1b18] dark:text-white">
                            <i class="fas fa-sign-in-alt mr-2 text-[#837227] dark:text-gray-400"></i> {{ __('Iniciar Sesión') }}
                        </x-flux::navlist.item>

                        <x-flux::navlist.item href="{{ route('home') }}" :current="request()->routeIs('home')" wire:navigate class="text-[#1b1b18] dark:text-white">
                            <i class="fas fa-home mr-2 text-[#837227] dark:text-gray-400"></i> {{ __('Inicio') }}
                        </x-flux::navlist.item>

                        <x-flux::navlist.item href="{{ route('nosotros') }}" :current="request()->routeIs('nosotros')" wire:navigate class="text-[#1b1b18] dark:text-white">
                            <i class="fas fa-users mr-2 text-[#837227] dark:text-gray-400"></i> {{ __('Nosotros') }}
                        </x-flux::navlist.item>

                        <x-flux::navlist.item href="{{ route('catalogo') }}" :current="request()->routeIs('catalogo')" wire:navigate class="text-[#1b1b18] dark:text-white">
                            <i class="fas fa-book-open mr-2 text-[#837227] dark:text-gray-400"></i> {{ __('Catálogo') }}
                        </x-flux::navlist.item>

                        <x-flux::navlist.item href="{{ route('contactos') }}" :current="request()->routeIs('contactos')" wire:navigate class="text-[#1b1b18] dark:text-white">
                            <i class="fas fa-envelope mr-2 text-[#837227] dark:text-gray-400"></i> {{ __('Contactos') }}
                        </x-flux::navlist.item>
                    @endguest
                </ul>
            </nav>
        </aside>

        {{-- Área de Contenido Principal --}}
        <main class="content-area">
            {{-- Contenido de la página Catálogo --}}
            <div class="p-6 bg-[#FDFDFC] dark:bg-[#0a0a0a] min-h-screen">
                {{-- Header para el Catálogo--}}
                <div class="flex items-center justify-center border-b-4 border-[#837227] pb-3 mb-6 max-w-2xl mx-auto">
                    <div class="flex items-center">
                        <img src="{{ asset('images/logo-riccharly.png') }}" alt="Riccharly Huami Logo" class="h-12 w-auto mr-4">
                        <div class="font-bold text-[#837227] text-2xl">Riccharly Huami</div>
                    </div>
                </div>

                {{-- Título y subtítulo de la página --}}
                <h1 class="text-center mb-2 font-bold text-4xl text-gray-800 dark:text-gray-200">Catálogo de Productos</h1>
                <p class="text-center text-lg text-gray-600 dark:text-gray-400 mb-8">Encuentra los mejores productos agropecuarios para tu negocio.</p>

                {{-- Formulario de búsqueda y filtros --}}
                {{-- Aplicando el estilo de tarjeta a este formulario --}}
                <form action="{{ route('catalogo') }}" method="GET" class="mb-10 max-w-4xl mx-auto flex flex-wrap items-center justify-center md:justify-between gap-4 p-4 seccion-tarjeta-estilo">
                
                <!--input de búsqueda --> 
                <div class="flex-grow">
                        <label for="search" class="sr-only">Buscar productos agropecuarios...</label>
                        <input type="text" name="search" id="search" placeholder="Buscar productos agropecuarios..."
                                value="{{ $searchTerm }}"
                                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-[#837227] focus:border-[#837227] dark:bg-gray-700 dark:text-gray-200">
                    </div>

                    <!--filtrar los productos por diferentes categorías--> 
                    <!-- menú desplegable para filtrar productos por categoría--> 
                    <div>
                        <label for="category" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Filtrar por:</label>
                        <select name="category" id="category"
                                class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-[#837227] focus:border-[#837227] sm:text-sm rounded-md dark:bg-gray-700 dark:text-gray-200 dark:border-gray-600">
                            <option value="Todos los productos" {{ $filterCategory === 'Todos los productos' ? 'selected' : '' }}>Todos los productos</option>
                            
                            @foreach ($orderedCategories as $cat)
                                <option value="{{ $cat }}" {{ $filterCategory === $cat ? 'selected' : '' }}>{{ $cat }}</option>
                            @endforeach
                        </select>
                    </div>


                    <!--selector de ordenamiento o  menú desplegable para ordenar los productos--> 
                    <div>
                        <label for="order_by" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Ordenar por:</label>
                        <select name="order_by" id="order_by"
                                class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-[#837227] focus:border-[#837227] sm:text-sm rounded-md dark:bg-gray-700 dark:text-gray-200 dark:border-gray-600">
                            <option value="name" {{ $orderBy === 'name' ? 'selected' : '' }}>Nombre</option>
                            <option value="price" {{ $orderBy === 'price' ? 'selected' : '' }}>Precio</option>
                            <option value="created_at" {{ $orderBy === 'created_at' ? 'selected' : '' }}>Más reciente</option>
                        </select>
                    </div>

                    <!--menú desplegable que controla si el orden de los productos es ascendente o descendente.--> 
                    <div>
                        <label for="order_direction" class="block text-sm font-medium text-gray-700 dark:text-gray-300 sr-only">Dirección</label>
                        <select name="order_direction" 
                                class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-[#837227] focus:border-[#837227] sm:text-sm rounded-md dark:bg-gray-700 dark:text-gray-200 dark:border-gray-600">
                            <option value="asc" {{ $orderDirection === 'asc' ? 'selected' : '' }}>Ascendente</option>
                            <option value="desc" {{ $orderDirection === 'desc' ? 'selected' : '' }}>Descendente</option>
                        </select>
                    </div>

                    <!--btn aplica--> 
                    <button type="submit" class="px-6 py-2 bg-[#837227] text-white rounded-md hover:bg-[#6b5a1a] transition duration-300 mt-4 md:mt-0">
                        Aplicar
                    </button>
                </form>


                <!--detector de productos--> 
                @php
                    
                    $hasProducts = false;
                    foreach ($orderedCategories as $categoria) {
                        if (!empty($groupedProducts[$categoria])) {
                            $hasProducts = true;
                            break;
                        }
                    }
                @endphp


                <!--mostrar los productos para el catálogo--> 
                @if ($hasProducts)
                    @foreach ($orderedCategories as $categoria)
                        @if (!empty($groupedProducts[$categoria]))
                            <section class="mb-12 max-w-6xl mx-auto">
                                <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-200 mb-4 border-b pb-2 border-gray-200 dark:border-gray-700">{{ $categoria }}</h2>
                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                                    @foreach ($groupedProducts[$categoria] as $product)
                                        {{-- Tarjeta de producto individual --}}
                                        {{-- Aplicando el estilo de tarjeta de producto --}}

                                        <div class="tarjeta-producto-estilo overflow-hidden flex flex-col">
                                            <img src="{{ asset($product->image_path ?: 'images/default-product.png') }}" alt="{{ $product->name }}" class="w-full h-48 object-cover">
                                            <div class="p-4 flex-grow flex flex-col justify-between">
                                                <div>
                                                    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-1">{{ $product->name }}</h3>
                                                    <p class="text-gray-600 dark:text-gray-400 text-sm mb-3">{{ Str::limit($product->description, 70) }}</p>
                                                </div>
                                                <div>
                                                    <div class="flex justify-between items-center mt-2">
                                                        <span class="text-xl font-bold text-[#837227] dark:text-[#a59a7c]">S/ {{ number_format($product->price, 2) }}</span>
                                                    </div>
                                                    @if ($product->stock < 10 && $product->stock > 0)
                                                        <p class="text-xs text-yellow-600 dark:text-yellow-400 mt-1">¡Pocas unidades! ({{ $product->stock }} en stock)</p>
                                                    @elseif ($product->stock == 0)
                                                        <p class="text-xs text-red-600 dark:text-red-400 mt-1">Agotado</p>
                                                    @endif

                                                    <div class="mt-3">
                                                        //btn añadir carrito :V
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

                <!--Sección: ¿Necesitas ayuda con tu compra? --> 
                <section class="seccion-tarjeta-estilo max-w-4xl mx-auto text-center py-12 px-6 mt-16">
                    <h2 class="text-3xl font-bold text-gray-800 dark:text-gray-200 mb-4">¿Necesitas ayuda con tu compra?</h2>
                    <p class="text-gray-600 dark:text-gray-400 mb-8">Nuestros asesores están disponibles para ayudarte a elegir los productos adecuados para tu negocio agrícola.</p>
                    <div class="flex flex-col sm:flex-row justify-center space-y-4 sm:space-y-0 sm:space-x-4">
                        <a href="tel:+51999123456" class="px-8 py-3 bg-[#8B805C] text-white rounded-md hover:bg-[#7a704e] transition duration-300 text-lg font-semibold">
                            Llamar a un asesor
                        </a>
                        <a href="{{ route('contactos') }}" class="px-8 py-3 border border-[#8B805C] text-[#8B805C] rounded-md hover:bg-[#f3f2f0] dark:hover:bg-gray-700 transition duration-300 text-lg font-semibold">
                            <svg class="w-5 h-5 mr-2 inline-block" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path><path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path></svg>
                            Enviar mensaje
                        </a>
                    </div>
                </section>

            </div>

            {{-- Footer --}}
            <footer class="bg-[#837227] dark:bg-[#7a704e] text-white p-8 mt-16">
                <div class="max-w-6xl mx-auto flex flex-col md:flex-row justify-between items-center text-center md:text-left">
                    <div class="mb-4 md:mb-0">
                        <h3 class="text-2xl font-bold mb-2">Riccharly Huami</h3>
                        <p class="text-sm">Agropecuaria de confianza desde 1995</p>
                    </div>
                    <div class="mb-4 md:mb-0">
                        <h4 class="text-lg font-semibold mb-2">Contacto</h4>
                        <p class="text-sm">Juliaca, Puno, Perú</p>
                        <p class="text-sm">info@riccharlyhuami.com</p>
                        <p class="text-sm">+51 987 654 321</p>
                    </div>
                    <div>
                        <h4 class="text-lg font-semibold mb-2">Síguenos</h4>
                        <div class="flex justify-center md:justify-start gap-4">
                            <a href="#" class="text-white hover:text-gray-200 transition-colors duration-300">Facebook</a>
                            <a href="#" class="text-white hover:text-gray-200 transition-colors duration-300">Instagram</a>
                            <a href="#" class="text-white hover:text-gray-200 transition-colors duration-300">LinkedIn</a>
                        </div>
                    </div>
                </div>
                <div class="text-center text-sm mt-8 pt-4 border-t border-gray-400">
                    &copy; {{ date('Y') }} Riccharly Huami Agropecuaria. Todos los derechos reservados.
                </div>
            </footer>
        </main>
    </div>
</body>
</html>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Contactos - Riccharly Huami Agropecuaria</title>

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
            {{-- Contenido de la página Contactos --}}
            <div class="p-6 bg-[#FDFDFC] dark:bg-[#0a0a0a] min-h-screen">
                <h1 class="text-4xl font-bold text-gray-800 dark:text-gray-200 mb-8 text-center">Contáctanos</h1>

                <section class="seccion-tarjeta-estilo p-10 mt-8 max-w-4xl mx-auto text-center">
                    <p class="text-lg text-gray-700 dark:text-gray-300 leading-relaxed mb-6">
                        ¿Tienes alguna pregunta, comentario o necesitas más información sobre nuestros productos y servicios? No dudes en contactarnos. Estamos aquí para ayudarte.
                    </p>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 text-left mt-8">
                        <div>
                            <h3 class="text-2xl font-semibold text-gray-800 dark:text-gray-200 mb-4">Información de Contacto</h3>
                            <p class="text-lg text-gray-700 dark:text-gray-300 mb-2">
                                <i class="fas fa-map-marker-alt text-[#8B805C] mr-2"></i> Comunidad de Huancané, Km 45 Carretera Puno-Juliaca
                            </p>
                            <p class="text-lg text-gray-700 dark:text-gray-300 mb-2">
                                <i class="fas fa-phone-alt text-[#8B805C] mr-2"></i> +51 951 234 567
                            </p>
                            <p class="text-lg text-gray-700 dark:text-gray-300 mb-2">
                                <i class="fas fa-envelope text-[#8B805C] mr-2"></i> contacto@riccharlyhuami.pe
                            </p>
                            <p class="text-lg text-gray-700 dark:text-gray-300 mb-2">
                                <i class="fas fa-clock text-[#8B805C] mr-2"></i> Lunes a Viernes: 8:00 AM - 9:00 PM
                            </p>
                        </div>

                        <div>
                            <h3 class="text-2xl font-semibold text-gray-800 dark:text-gray-200 mb-4">Envíanos un Mensaje</h3>
                            <form class="space-y-4">
                                <div>
                                    <label for="nombre" class="sr-only">Nombre</label>
                                    <input type="text" id="nombre" name="nombre" placeholder="Tu Nombre"
                                           class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md focus:ring-[#8B805C] focus:border-[#8B805C] dark:bg-gray-700 dark:text-gray-200 text-gray-800 placeholder-gray-400">
                                </div>
                                <div>
                                    <label for="email" class="sr-only">Correo Electrónico</label>
                                    <input type="email" id="email" name="email" placeholder="Tu Correo Electrónico"
                                           class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md focus:ring-[#8B805C] focus:border-[#8B805C] dark:bg-gray-700 dark:text-gray-200 text-gray-800 placeholder-gray-400">
                                </div>
                                <div>
                                    <label for="mensaje" class="sr-only">Mensaje</label>
                                    <textarea id="mensaje" name="mensaje" rows="5" placeholder="Tu Mensaje"
                                              class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md focus:ring-[#8B805C] focus:border-[#8B805C] dark:bg-gray-700 dark:text-gray-200 text-gray-800 placeholder-gray-400"></textarea>
                                </div>
                                <button type="submit" class="bg-[#837227] hover:bg-[#7a704e] text-white px-6 py-3 rounded-md font-semibold transition duration-300">
                                    Enviar Mensaje
                                </button>
                            </form>
                        </div>
                    </div>
                </section>

                {{-- Sección de Mapa (Ejemplo de iFrame de Google Maps) --}}
                <section class="seccion-tarjeta-estilo p-6 mt-16 max-w-6xl mx-auto">
                    <h2 class="text-3xl font-bold text-gray-800 dark:text-gray-200 mb-6 text-center">Encuéntranos en el Mapa</h2>
                    <div class="aspect-w-16 aspect-h-9 w-full h-96 rounded-lg overflow-hidden shadow-lg">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15383.67490799839!2d-70.02693895!3d-15.836483449999999!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x9167f407b8979313%3A0x8e8b0a9f5d3b6f2!2sJuliaca%2C%20Puno%2C%20Peru!5e0!3m2!1sen!2sus!4v1700000000000!5m2!1sen!2sus"
                            width="100%"
                            height="100%"
                            style="border:0;"
                            allowfullscreen=""
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
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

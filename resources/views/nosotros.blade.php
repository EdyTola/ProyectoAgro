<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Nosotros - Riccharly Huami Agropecuaria</title>

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
            {{-- Contenido de la página Nosotros --}}
            <div class="p-6 bg-[#FDFDFC] dark:bg-[#0a0a0a] min-h-screen">
                <h1 class="text-4xl font-bold text-gray-800 dark:text-gray-200 mb-8 text-center">Nosotros</h1>

                {{-- Sección Nuestra Historia --}}
                <section class="seccion-tarjeta-estilo p-10 mt-8 max-w-4xl mx-auto">
                    <h2 class="text-3xl font-bold text-gray-800 dark:text-gray-200 mb-6 text-center">Nuestra Historia</h2>
                    <p class="text-lg text-gray-700 dark:text-gray-300 leading-relaxed mb-4">
                        Fundada en 1998 por la familia Huami en las alturas de Puno, Riccharly Huami Agropecuaria nació como un pequeño emprendimiento familiar dedicado al cultivo de papas nativas y la crianza de alpacas. Con el paso de los años, hemos crecido hasta convertirnos en una referencia en la producción agropecuaria sostenible de la región.
                    </p>
                    <p class="text-lg text-gray-700 dark:text-gray-300 leading-relaxed mb-4">
                        Nuestro nombre "Riccharly" proviene del quechua y significa "despertar abundante", reflejando nuestra conexión con la tierra y el compromiso con prácticas agrícolas que respetan los ciclos naturales y las tradiciones ancestrales de nuestros antepasados.
                    </p>
                    <p class="text-lg text-gray-700 dark:text-gray-300 leading-relaxed">
                        Hoy, con más de dos décadas de experiencia, seguimos fieles a nuestras raíces mientras incorporamos tecnologías modernas que nos permiten mejorar la calidad de nuestros productos sin comprometer nuestros valores fundamentales.
                    </p>
                </section>

                {{-- Sección Nuestra Misión y Valores --}}
                <section class="max-w-6xl mx-auto mt-16 mb-12">
                    <h2 class="text-3xl font-bold text-gray-800 dark:text-gray-200 mb-8 text-center">Nuestra Misión y Valores</h2>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
                        <div class="tarjeta-testimonio-estilo p-6 flex flex-col items-center">
                            <div class="w-20 h-20 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center text-[#8B805C] text-4xl mb-4">
                                <i class="fas fa-leaf"></i>
                            </div>
                            <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-2">Sostenibilidad</h3>
                            <p class="text-gray-600 dark:text-gray-400 text-sm">Implementamos prácticas agrícolas que preservan el suelo, conservan el agua y protegen la biodiversidad local, garantizando la salud de nuestras tierras para las generaciones futuras.</p>
                        </div>
                        <div class="tarjeta-testimonio-estilo p-6 flex flex-col items-center">
                            <div class="w-20 h-20 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center text-[#8B805C] text-4xl mb-4">
                                <i class="fas fa-handshake"></i>
                            </div>
                            <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-2">Comunidad</h3>
                            <p class="text-gray-600 dark:text-gray-400 text-sm">Trabajamos en estrecha colaboración con las comunidades locales, generando empleo justo y apoyando iniciativas que mejoran la calidad de vida en la región de Puno.</p>
                        </div>
                        <div class="tarjeta-testimonio-estilo p-6 flex flex-col items-center">
                            <div class="w-20 h-20 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center text-[#8B805C] text-4xl mb-4">
                                <i class="fas fa-seedling"></i>
                            </div>
                            <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-2">Calidad</h3>
                            <p class="text-gray-600 dark:text-gray-400 text-sm">Nos comprometemos a ofrecer productos agropecuarios de la más alta calidad, cultivados con cuidado y respeto por los ciclos naturales y las tradiciones ancestrales andinas.</p>
                        </div>
                    </div>
                </section>

                {{-- Sección Nuestro Equipo --}}
                <section class="max-w-6xl mx-auto mt-16 mb-12">
                    <h2 class="text-3xl font-bold text-gray-800 dark:text-gray-200 mb-8 text-center">Nuestro Equipo</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 text-center">
                        <div class="tarjeta-testimonio-estilo p-6">
                            <img src="{{ asset('images/ricardo.jpg') }}" alt="Ricardo Huami" class="w-32 h-32 rounded-full mx-auto mb-4 object-cover">
                            <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-200">Ricardo Huami</h3>
                            <p class="text-gray-600 dark:text-gray-400 text-sm">Fundador y Director General</p>
                        </div>
                        <div class="tarjeta-testimonio-estilo p-6">
                            <img src="{{ asset('images/maria.jpg') }}" alt="María Quispe" class="w-32 h-32 rounded-full mx-auto mb-4 object-cover">
                            <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-200">María Quispe</h3>
                            <p class="text-gray-600 dark:text-gray-400 text-sm">Directora de Producción Agrícola</p>
                        </div>
                        <div class="tarjeta-testimonio-estilo p-6">
                            <img src="{{ asset('images/carlos.jpg') }}" alt="Carlos Huami" class="w-32 h-32 rounded-full mx-auto mb-4 object-cover">
                            <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-200">Carlos Huami</h3>
                            <p class="text-gray-600 dark:text-gray-400 text-sm">Director de Ganadería</p>
                        </div>
                        <div class="tarjeta-testimonio-estilo p-6">
                            <img src="{{ asset('images/laura.jpg') }}" alt="Laura Mamani" class="w-32 h-32 rounded-full mx-auto mb-4 object-cover">
                            <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-200">Laura Mamani</h3>
                            <p class="text-gray-600 dark:text-gray-400 text-sm">Directora de Sostenibilidad</p>
                        </div>
                    </div>
                </section>

                {{-- Sección Nuestra Ubicación --}}
                <section class="seccion-tarjeta-estilo p-10 mt-16 max-w-4xl mx-auto">
                    <h2 class="text-3xl font-bold text-gray-800 dark:text-gray-200 mb-6 text-center">Nuestra Ubicación</h2>
                    <p class="text-lg text-gray-700 dark:text-gray-300 leading-relaxed mb-4">
                        Estamos ubicados en el corazón de la región de Puno, a 3,850 metros sobre el nivel del mar; en un entorno privilegiado que combina la belleza del altiplano andino con condiciones ideales para nuestros cultivos especializados.
                    </p>
                    <p class="text-lg text-gray-700 dark:text-gray-300 leading-relaxed mb-4">
                        Nuestras instalaciones principales se encuentran a 45 minutos de la ciudad de Puno, en la comunidad de Huancané, donde mantenemos más de 200 hectáreas de terrenos cultivables y zonas de pastoreo para nuestro ganado.
                    </p>
                    <div class="text-lg text-gray-700 dark:text-gray-300 mt-6">
                        <h3 class="text-xl font-semibold mb-2">Visítanos</h3>
                        <p>Comunidad de Huancané, Km 45 Carretera Puno-Juliaca</p>
                        <p>+51 951 234 567</p>
                        <p>contacto@riccharlyhuami.pe</p>
                    </div>
                </section>

                {{-- Sección Nuestros Métodos de Producción --}}
                <section class="max-w-6xl mx-auto py-12 mt-16">
                    <h2 class="text-3xl font-bold text-gray-800 dark:text-gray-200 mb-8 text-center">Nuestros Métodos de Producción</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="tarjeta-testimonio-estilo p-6 flex items-start">
                            <div class="w-16 h-16 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center text-[#8B805C] text-3xl mr-4 flex-shrink-0">
                                <i class="fas fa-tractor"></i>
                            </div>
                            <div>
                                <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-2">Agricultura Sostenible</h3>
                                <p class="text-gray-600 dark:text-gray-400 mb-4">Combinamos técnicas ancestrales andinas con innovaciones modernas para cultivar más de 15 variedades de papas nativas, quinua, cañihua y otros cultivos andinos.</p>
                                <ul class="list-none space-y-2 text-gray-700 dark:text-gray-300">
                                    <li class="flex items-center"><i class="fas fa-check-circle text-[#8B805C] mr-2"></i> Rotación de cultivos para mantener la fertilidad del suelo</li>
                                    <li class="flex items-center"><i class="fas fa-check-circle text-[#8B805C] mr-2"></i> Uso de abonos orgánicos producidos en nuestra propia granja</li>
                                    <li class="flex items-center"><i class="fas fa-check-circle text-[#8B805C] mr-2"></i> Sistemas de riego por goteo que optimizan el uso del agua</li>
                                    <li class="flex items-center"><i class="fas fa-check-circle text-[#8B805C] mr-2"></i> Control biológico de plagas sin uso de pesticidas químicos</li>
                                </ul>
                            </div>
                        </div>

                        <div class="tarjeta-testimonio-estilo p-6 flex items-start">
                            <div class="w-16 h-16 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center text-[#8B805C] text-3xl mr-4 flex-shrink-0">
                                <i class="fas fa-horse-head"></i>
                            </div>
                            <div>
                                <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-2">Ganadería Responsable</h3>
                                <p class="text-gray-600 dark:text-gray-400 mb-4">Criamos alpacas, llamas y ganado vacuno adaptado a la altura, siguiendo prácticas que garantizan el bienestar animal y la calidad de nuestros productos.</p>
                                <ul class="list-none space-y-2 text-gray-700 dark:text-gray-300">
                                    <li class="flex items-center"><i class="fas fa-check-circle text-[#8B805C] mr-2"></i> Pastoreo rotativo en praderas naturales de altura</li>
                                    <li class="flex items-center"><i class="fas fa-check-circle text-[#8B805C] mr-2"></i> Alimentación complementaria con forrajes cultivados en nuestra granja</li>
                                    <li class="flex items-center"><i class="fas fa-check-circle text-[#8B805C] mr-2"></i> Manejo sanitario preventivo con medicina tradicional andina</li>
                                    <li class="flex items-center"><i class="fas fa-check-circle text-[#8B805C] mr-2"></i> Esquila responsable de alpacas y procesamiento artesanal de la fibra</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </section>

            </div>

            
        </main>
    </div>
</body>
</html>

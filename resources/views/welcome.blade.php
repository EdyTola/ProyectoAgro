<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Inicio - Riccharly Huami Agropecuaria</title>

        <link rel="icon" href="/favicon.ico" sizes="any">
        <link rel="icon" href="/favicon.svg" type="image/svg+xml">
        <link rel="apple-touch-icon" href="/apple-touch-icon.png">

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

        <!-- Carga los estilos de Tailwind CSS -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

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

            /* Estilo para las tarjetas individuales de testimonios */
            .tarjeta-testimonio-estilo {
                background-color: #fff;
                border-radius: 12px;
                box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            }

            .dark .tarjeta-testimonio-estilo {
                background-color: #1f2937;
                box-shadow: 0 4px 20px rgba(0, 0, 0, 0.4);
            }
        </style>
    </head>
    <body class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-gray-800 dark:text-gray-200 antialiased">

        
        <nav class="w-full bg-[#837227] dark:bg-[#7a704e] p-4 flex justify-between items-center shadow-md fixed top-0 left-0 z-50">
            <div class="flex items-center gap-4">
                
                <img src="{{ asset('images/logo-riccharly.png') }}" alt="Riccharly Huami Logo" class="h-8 w-auto">
                <span class="text-white text-lg font-semibold">Riccharly Huami</span>
            </div>
            {{-- Autenticación y Registro --}}
            @if (Route::has('login'))
                <div class="flex items-center gap-4">
                    @auth
                        <a
                            href="{{ url('/dashboard') }}"
                            class="inline-block px-5 py-1.5 text-white border border-white hover:border-gray-200 rounded-sm text-sm leading-normal"
                        >
                            Inicio
                        </a>
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

        {{-- Contenido Principal (Agropecuaria Riccharly Huami y mensaje) --}}
        <div class="flex flex-col items-center justify-center min-h-[calc(100vh-64px)] mt-16 p-6">
            <div class="text-center bg-transparent p-6 rounded-lg max-w-2xl">
                <h1 class="text-4xl md:text-5xl font-bold text-black-800 dark:text-red-200 mb-4">Agropecuaria Riccharly Huami</h1>
                <p class="text-lg text-gray-600 dark:text-gray-400 mb-8">
                    Inicia Sesión o Regístrate, es gratis no tardas nada.
                </p>
            </div>
        </div>

        {{-- Sección "Sobre Riccharly Huami" --}}
        <div class="seccion-tarjeta-estilo p-10 mt-16 max-w-4xl mx-auto">
            <h2 class="text-3xl font-bold text-gray-800 dark:text-gray-200 mb-6 text-center">Sobre Riccharly Huami</h2>
            <div class="text-lg text-gray-700 dark:text-gray-300 space-y-4">
                <p>
                    Somos una empresa agropecuaria familiar ubicada en Puno, Perú, dedicada a la
                    producción y comercialización de productos agrícolas y ganaderos de alta calidad
                    desde 1995.
                </p>
                <p>
                    Nuestro compromiso es preservar las tradiciones agrícolas andinas mientras
                    implementamos técnicas modernas y sostenibles para ofrecer los mejores productos
                    del altiplano peruano.
                </p>
                <p>
                    Trabajamos directamente con comunidades locales, asegurando precios justos para
                    los productores y la más alta calidad para nuestros clientes.
                </p>
            </div>
        </div>

        {{-- Sección "Lo que dicen nuestros clientes" (Testimonios) --}}
        <div class="bg-[#FDFDFC] dark:bg-[#0a0a0a] p-8 md:p-12 mt-16 text-center">
            <h2 class="text-3xl font-bold text-gray-800 dark:text-gray-200 mb-8">Lo que dicen nuestros clientes</h2>
            <p class="text-lg text-gray-600 dark:text-gray-400 mb-12">
                Testimonios de quienes confían en la calidad de nuestros productos
            </p>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 max-w-6xl mx-auto">
                {{-- Testimonio 1 --}}
                <div class="tarjeta-testimonio-estilo p-6 flex flex-col items-center text-center">
                    <img src="{{ asset('images/maria.jpg') }}" alt="Maria Condori" class="rounded-full w-20 h-20 mb-4 object-cover">
                    <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-1">María Condori</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">Restaurante "Sabores Andinos"</p>
                    <p class="text-gray-700 dark:text-gray-300 italic mb-4">
                        "Los productos de Riccharly Huami son excepcionales. La quinua y las papas nativas que
                        compramos para nuestro restaurante siempre están frescas y son de la mejor calidad. Nuestros
                        clientes notan la diferencia."
                    </p>
                    <div class="flex justify-center text-yellow-500 text-lg">
                        &#9733;&#9733;&#9733;&#9733;&#9733; 
                    </div>
                </div>

                {{-- Testimonio 2 --}}
                <div class="tarjeta-testimonio-estilo p-6 flex flex-col items-center text-center">
                    <img src="{{ asset('images/jorge.jpg') }}" alt="Jorge Mamani" class="rounded-full w-20 h-20 mb-4 object-cover">
                    <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-1">Jorge Mamani</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">Distribuidor en Arequipa</p>
                    <p class="text-gray-700 dark:text-gray-300 italic mb-4">
                        "Llevo 5 años distribuyendo los productos de Riccharly Huami en Arequipa y la demanda sigue
                        creciendo. La consistencia en la calidad y la puntualidad en las entregas hacen que sea un
                        placer trabajar con ellos."
                    </p>
                    <div class="flex justify-center text-yellow-500 text-lg">
                        &#9733;&#9733;&#9733;&#9733;&#9734; {{-- Estrellas --}}
                    </div>
                </div>

                {{-- Testimonio 3 --}}
                <div class="tarjeta-testimonio-estilo p-6 flex flex-col items-center text-center">
                    <img src="{{ asset('images/lucia.jpg') }}" alt="Lucia Flores" class="rounded-full w-20 h-20 mb-4 object-cover">
                    <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-1">Lucia Flores</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">Cliente habitual</p>
                    <p class="text-gray-700 dark:text-gray-300 italic mb-4">
                        "Desde que descubrí los productos de Riccharly Huami, mi familia y yo no compramos en otro lugar.
                        El sabor auténtico de sus productos nos recuerda a los que consumíamos en nuestra infancia en el
                        campo."
                    </p>
                    <div class="flex justify-center text-yellow-500 text-lg">
                        &#9733;&#9733;&#9733;&#9733;&#9733; {{-- Estrellas --}}
                    </div>
                </div>
            </div>
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

    </body>
</html>
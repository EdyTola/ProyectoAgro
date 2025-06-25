<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} {{ isset($title) ? ' - ' . $title : '' }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-[#FDFDFC] dark:bg-[#0a0a0a]">
    {{-- La barra de navegación superior (Navbar) --}}
    <nav class="w-full bg-[#8B805C] dark:bg-[#7a704e] p-4 flex justify-between items-center shadow-md fixed top-0 left-0 z-50">
        <div class="flex items-center gap-4">
            {{-- Logo Riccharly Huami --}}
            <img src="{{ asset('images/logo-riccharly.png') }}" alt="Riccharly Huami Logo" class="h-8 w-auto">
            <span class="text-white text-lg font-semibold">Riccharly Huami</span>
        </div>

        {{-- Barra de búsqueda (opcional, si no la usas puedes quitarla) --}}
        <div class="flex-grow mx-4 max-w-sm">
            <input type="text" placeholder="Buscar..." class="w-full p-2 rounded-md bg-white/20 text-white placeholder-white/70 border border-transparent focus:outline-none focus:ring-1 focus:ring-white">
        </div>

        {{-- Autenticación y Registro --}}
        @if (Route::has('login'))
            <div class="flex items-center gap-4">
                @auth
                    <div class="flex items-center text-white no-underline cursor-default">
                        {{-- Avatar/Inicial del usuario --}}
                        <div class="w-8 h-8 rounded-full bg-white flex items-center justify-center text-[#8B805C] text-base font-bold uppercase mr-2 shadow-sm">
                            {{ substr(Auth::user()->name, 0, 1) }}
                        </div>
                        {{-- Nombre completo del usuario --}}
                        <span class="text-base font-medium">
                            {{ Auth::user()->name }}
                        </span>
                    </div>

                    {{-- Formulario para Cerrar Sesión --}}
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="inline-block px-5 py-1.5 text-white border border-white hover:border-gray-200 rounded-sm text-sm leading-normal ml-4">
                            Cerrar Sesión
                        </button>
                    </form>

                @else
                    <a href="{{ route('login') }}" class="inline-block px-5 py-1.5 text-white border border-transparent hover:border-gray-200 rounded-sm text-sm leading-normal">
                        Log in
                    </a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="inline-block px-5 py-1.5 text-white border border-white hover:border-gray-200 rounded-sm text-sm leading-normal">
                            Register
                        </a>
                    @endif
                @endauth
            </div>
        @endif
    </nav>

    {{-- Contenedor principal para Sidebar y Contenido --}}
    <div class="flex flex-1 min-h-screen pt-16 overflow-hidden">
        {{-- SIDEBAR --}}
        <aside class="w-64 bg-white dark:bg-gray-800 text-[#1b1b18] dark:text-gray-200 shadow-md fixed top-16 left-0 h-[calc(100vh-64px)] z-40 overflow-y-auto">
            @include('components.layouts.app.sidebar')
        </aside>

        {{-- Contenido Principal de la Página --}}
        <main class="flex-1 ml-64 p-6 overflow-y-auto h-[calc(100vh-64px)]">
            {{ $slot }}
        </main>
    </div>

</body>
</html>
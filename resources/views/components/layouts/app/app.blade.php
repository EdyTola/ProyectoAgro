<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riccharly Huami Agropecuaria</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                    colors: {
                        primary: '#837227', // Color principal de Riccharly Huami
                        secondary: '#8B805C', // Color secundario
                        darkBg: '#0a0a0a', // Fondo oscuro para modo oscuro
                        lightBg: '#FDFDFC', // Fondo claro para modo claro
                    }
                }
            }
        }
    </script>
    <!-- Enlaces a Font Awesome para iconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body class="font-sans bg-lightBg dark:bg-darkBg antialiased text-gray-800 dark:text-white">
    <div class="flex min-h-screen">
        <!-- Sidebar - Incluido una sola vez en la plantilla maestra -->
        <aside class="w-64 bg-gray-800 text-white p-4 rounded-r-lg shadow-lg flex flex-col">
            <!-- Incluye el contenido del sidebar desde su propio archivo Blade -->
            @include('layouts.sidebar')
        </aside>

        <!-- Contenido principal de la página -->
        <main class="flex-1 p-6 lg:p-8">
            <!-- Aquí se inyectará el contenido específico de cada vista que extienda este layout -->
            @yield('content')
        </main>
    </div>
</body>
</html>
```html
<!-- resources/views/layouts/sidebar.blade.php -->
<!-- Este archivo contiene el código HTML para el sidebar de navegación.
     Se incluye en la plantilla maestra (app.blade.php).
     SOLO incluye los enlaces a las páginas existentes en tu aplicación. -->
<nav class="space-y-4">
    <div class="text-2xl font-bold text-center mb-6 text-primary">
        Riccharly Huami
    </div>
    <ul>
        <li class="mb-2">
            <a href="/dashboard" class="flex items-center p-3 rounded-lg hover:bg-gray-700 transition duration-200 ease-in-out">
                <i class="fas fa-tachometer-alt mr-3"></i>
                Dashboard
            </a>
        </li>
        <li class="mb-2">
            <a href="/catalogo" class="flex items-center p-3 rounded-lg hover:bg-gray-700 transition duration-200 ease-in-out">
                <i class="fas fa-box-open mr-3"></i>
                Catálogo
            </a>
        </li>
        <li class="mb-2">
            <a href="/nosotros" class="flex items-center p-3 rounded-lg hover:bg-gray-700 transition duration-200 ease-in-out">
                <i class="fas fa-users mr-3"></i>
                Nosotros
            </a>
        </li>
        <li class="mb-2">
            <a href="/contactos" class="flex items-center p-3 rounded-lg hover:bg-gray-700 transition duration-200 ease-in-out">
                <i class="fas fa-envelope mr-3"></i>
                Contactos
            </a>
        </li>
        <!-- Asegúrate de que la ruta 'cart.index' esté definida en routes/web.php -->
        <li class="mb-2">
            <a href="/cart" class="flex items-center p-3 rounded-lg hover:bg-gray-700 transition duration-200 ease-in-out">
                <i class="fas fa-shopping-cart mr-3"></i>
                Carrito
            </a>
        </li>
        <!-- Asegúrate de que la ruta 'boleta' esté definida en routes/web.php -->
        <li class="mb-2">
            <a href="/boleta" class="flex items-center p-3 rounded-lg hover:bg-gray-700 transition duration-200 ease-in-out">
                <i class="fas fa-receipt mr-3"></i>
                Boleta
            </a>
        </li>
    </ul>
</nav>
```html
<!-- resources/views/dashboard.blade.php -->
<!-- Este es un archivo de vista específico para el Dashboard.
     Extiende la plantilla maestra (layouts/app.blade.php) y solo define su contenido único.
     Las tarjetas de ejemplo y la actividad reciente se han ajustado para ser genéricas
     o relevantes a tu aplicación sin mencionar SOATS/Vehículos. -->
@extends('layouts.app') <!-- Indica que esta vista extiende la plantilla 'layouts/app' -->

@section('content') <!-- Define la sección 'content' que se inyectará en el layout -->
    <h1 class="text-4xl font-extrabold text-gray-800 dark:text-white mb-6 pb-2 border-b-2 border-primary">
        <i class="fas fa-chart-line text-primary mr-3"></i>Dashboard Principal
    </h1>

    <p class="text-gray-700 dark:text-gray-300 text-lg mb-8">
        Bienvenido a tu panel de control. Aquí puedes ver un resumen rápido de la actividad de tu aplicación.
    </p>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- Tarjeta de ejemplo 1: Productos en Catálogo -->
        <div class="bg-white dark:bg-gray-700 p-6 rounded-xl shadow-md hover:shadow-lg transition-shadow duration-300">
            <div class="flex items-center mb-4">
                <div class="p-3 bg-blue-100 dark:bg-blue-800 rounded-full text-blue-600 dark:text-blue-200 mr-4">
                    <i class="fas fa-box-open text-2xl"></i>
                </div>
                <h2 class="text-xl font-semibold text-gray-800 dark:text-white">Productos en Catálogo</h2>
            </div>
            <p class="text-4xl font-bold text-gray-900 dark:text-white">1,234</p>
            <p class="text-gray-500 dark:text-gray-400 mt-2">Total de productos disponibles.</p>
        </div>

        <!-- Tarjeta de ejemplo 2: Nuevos Contactos -->
        <div class="bg-white dark:bg-gray-700 p-6 rounded-xl shadow-md hover:shadow-lg transition-shadow duration-300">
            <div class="flex items-center mb-4">
                <div class="p-3 bg-green-100 dark:bg-green-800 rounded-full text-green-600 dark:text-green-200 mr-4">
                    <i class="fas fa-envelope text-2xl"></i>
                </div>
                <h2 class="text-xl font-semibold text-gray-800 dark:text-white">Nuevos Mensajes</h2>
            </div>
            <p class="text-4xl font-bold text-gray-900 dark:text-white">876</p>
            <p class="text-gray-500 dark:text-gray-400 mt-2">Mensajes recibidos este mes.</p>
        </div>

        <!-- Tarjeta de ejemplo 3: Usuarios Registrados -->
        <div class="bg-white dark:bg-gray-700 p-6 rounded-xl shadow-md hover:shadow-lg transition-shadow duration-300">
            <div class="flex items-center mb-4">
                <div class="p-3 bg-yellow-100 dark:bg-yellow-800 rounded-full text-yellow-600 dark:text-yellow-200 mr-4">
                    <i class="fas fa-users text-2xl"></i>
                </div>
                <h2 class="text-xl font-semibold text-gray-800 dark:text-white">Usuarios Registrados</h2>
            </div>
            <p class="text-4xl font-bold text-gray-900 dark:text-white">567</p>
            <p class="text-gray-500 dark:text-gray-400 mt-2">Usuarios con acceso a la plataforma.</p>
        </div>
    </div>

    <div class="mt-10 p-6 bg-white dark:bg-gray-700 rounded-xl shadow-md">
        <h2 class="text-2xl font-semibold text-gray-800 dark:text-white mb-4">Actividad Reciente</h2>
        <ul class="space-y-3 text-gray-700 dark:text-gray-300">
            <li class="flex items-center">
                <i class="fas fa-check-circle text-green-500 mr-3"></i>
                Nuevo producto "Papa Nativa Andina" añadido al catálogo.
            </li>
            <li class="flex items-center">
                <i class="fas fa-info-circle text-blue-500 mr-3"></i>
                Mensaje recibido de "Juan Pérez" a través del formulario de contacto.
            </li>
            <li class="flex items-center">
                <i class="fas fa-user-plus text-purple-500 mr-3"></i>
                Nuevo usuario "Maria Garcia" se ha registrado.
            </li>
        </ul>
    </div>
@endsection
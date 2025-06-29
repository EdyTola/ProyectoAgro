<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\BoletaController;
// Asegúrate de que todas las clases usadas estén importadas aquí
// Por ejemplo, si usas UserProfile en alguna ruta comentada, deberías tener su 'use'

// Ruta para la página de Inicio (tu página principal)
Route::get('/', function () {
    return view('welcome'); // Asumiendo que 'welcome.blade.php' es tu página de inicio
})->name('home');

// Rutas para las páginas estáticas "Nosotros" y "Contactos"
Route::get('/nosotros', function () {
    return view('nosotros'); // Esta vista debe existir en resources/views/nosotros.blade.php
})->name('nosotros');

Route::get('/contactos', function () {
    return view('contactos'); // Esta vista debe existir en resources/views/contactos.blade.php
})->name('contactos');

// SECCIÓN DEL CATÁLOGO
// Usamos el CatalogController para mostrar los productos
Route::get('/catalogo', [CatalogController::class, 'index'])->name('catalogo');
// FIN DE LA SECCIÓN DEL CATÁLOGO

// Rutas que requieren autenticación para TODOS los usuarios logeados
Route::middleware(['auth'])->group(function () {
    // Ruta del dashboard
    Route::view('dashboard', 'dashboard')->name('dashboard');

    // Estas rutas de settings se asumen que ya existían y no tienen que ver con el perfil principal
    Route::redirect('settings', 'settings/profile');
    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');

    // La ruta del carrito - la hemos dejado si quieres que la página exista, solo ocultaste el enlace
    Volt::route('/carrito', 'shopping-cart')->name('cart.index');

    // Volt::route('/profile', UserProfile::class)->name('profile');
});

// Rutas ESPECÍFICAS PARA ADMINISTRADORES (requieren autenticación Y el rol 'administrador')
// Este grupo DEBE ir FUERA del grupo 'auth' general si quieres que el middleware 'role' actúe
Route::middleware(['auth', 'role:administrador'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return "<h1>Bienvenido al Panel de Administración!</h1><p>Solo para administradores.</p>";
    })->name('admin.dashboard');

    // Aquí podrías añadir más rutas de administración, por ejemplo, para gestionar productos
    // Route::get('/admin/products', [AdminProductController::class, 'index'])->name('admin.products');
});

// Incluye las rutas de autenticación de Laravel Breeze/Jetstream
require __DIR__.'/auth.php';

Route::get('/boleta', [BoletaController::class, 'show'])->name('boleta');
Route::post('/boleta', [BoletaController::class, 'store'])->name('boleta.store');
Route::post('/boleta/imprimir', [BoletaController::class, 'imprimirVoucher'])->name('boleta.imprimir');
Route::get('/boleta/pdf', [BoletaController::class, 'downloadPDF'])->name('boleta.pdf');

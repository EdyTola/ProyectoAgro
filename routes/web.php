<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\BoletaController;
use Illuminate\Support\Facades\Auth; // Necesario para Auth::user() en el layout o para futuras lógicas

// Ruta para la página de Inicio (tu página principal)
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Rutas para las páginas estáticas "Nosotros" y "Contactos"
Route::get('/nosotros', function () {
    return view('nosotros');
})->name('nosotros');

Route::get('/contactos', function () {
    return view('contactos');
})->name('contactos');

// SECCIÓN DEL CATÁLOGO
Route::get('/catalogo', [CatalogController::class, 'index'])->name('catalogo');

// Rutas que requieren autenticación para TODOS los usuarios logeados
Route::middleware(['auth'])->group(function () {
    // Ruta del dashboard estándar para cualquier usuario autenticado (incluidos admins por ahora)
    Route::view('dashboard', 'dashboard')->name('dashboard');

    // Rutas de settings
    Route::redirect('settings', 'settings/profile');
    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');

    // Ruta del carrito
    Volt::route('/carrito', 'shopping-cart')->name('cart.index');

    // --- LA RUTA DEL PANEL DE ADMINISTRACIÓN HA SIDO ELIMINADA ---
    // Si en el futuro quieres una sección exclusiva para administradores,
    // la crearemos aquí de nuevo.
});

// Rutas de Boleta
Route::get('/boleta', [BoletaController::class, 'show'])->name('boleta');
Route::post('/boleta', [BoletaController::class, 'store'])->name('boleta.store');
Route::post('/boleta/imprimir', [BoletaController::class, 'imprimirVoucher'])->name('boleta.imprimir');
Route::get('/boleta/pdf', [BoletaController::class, 'downloadPDF'])->name('boleta.pdf');

// Incluye las rutas de autenticación de Laravel Breeze/Jetstream
require __DIR__.'/auth.php';
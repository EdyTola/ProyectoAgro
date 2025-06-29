<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\BoletaController;
use Illuminate\Support\Facades\Auth; // Necesario para Auth::user() en la verificación de rol

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
    // Ruta del dashboard estándar para cualquier usuario autenticado
    Route::view('dashboard', 'dashboard')->name('dashboard');

    // Rutas de settings
    Route::redirect('settings', 'settings/profile');
    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');

    // Ruta del carrito
    Volt::route('/carrito', 'shopping-cart')->name('cart.index');

    // --- RUTA PARA LA PÁGINA VACÍA DEL ADMINISTRADOR ---
    // Esta ruta está protegida por 'auth' (usuario logueado),
    // y la verificación de rol 'administrador' se hace directamente en la propia función.
    // NO USA RoleMiddleware.php.
    Route::get('/admin/blank-page', function () {
        // Verificación de rol DIRECTA para asegurar que solo los administradores accedan
        if (!Auth::check() || Auth::user()->role !== 'administrador') {
            abort(403, 'Acceso denegado. No tienes permisos de administrador.');
        }
        return view('admin.blank-panel'); // Apunta a la vista vacía del panel de administrador
    })->name('admin.blank_page'); // Nombre de la ruta, usado en login.blade.php y sidebar
    // --- FIN RUTA ADMINISTRADOR ---
});

// Rutas de Boleta
Route::get('/boleta', [BoletaController::class, 'show'])->name('boleta');
Route::post('/boleta', [BoletaController::class, 'store'])->name('boleta.store');
Route::post('/boleta/imprimir', [BoletaController::class, 'imprimirVoucher'])->name('boleta.imprimir');
Route::get('/boleta/pdf', [BoletaController::class, 'downloadPDF'])->name('boleta.pdf');

// Incluye las rutas de autenticación de Laravel Breeze/Jetstream
require __DIR__.'/auth.php';
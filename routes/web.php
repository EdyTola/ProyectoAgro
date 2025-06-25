<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Http\Controllers\CatalogController;
// No necesitamos 'use App\Livewire\UserProfile;' si no hay página de perfil específica para un componente Livewire

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

// SECCIÓN DEL CATÁLOGO (Deja esto como está)
// Ruta para la página pública del catálogo
// Usamos el CatalogController para mostrar los productos
Route::get('/catalogo', [CatalogController::class, 'index'])->name('catalogo');
// FIN DE LA SECCIÓN DEL CATÁLOGO

// Rutas que requieren autenticación
Route::middleware(['auth'])->group(function () {
    // Rutas existentes de tu dashboard y configuración
    Route::view('dashboard', 'dashboard')->name('dashboard');

    // Estas rutas de settings se asumen que ya existían y no tienen que ver con el perfil principal
    Route::redirect('settings', 'settings/profile');
    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
    Volt::route('/carrito', 'shopping-cart')->name('cart.index');
    // Si no hay una página de perfil dedicada con Livewire, quita esta línea si existía
    // Volt::route('/profile', UserProfile::class)->name('profile');
});

// Incluye las rutas de autenticación de Laravel Breeze/Jetstream
require __DIR__.'/auth.php';
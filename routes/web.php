<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\BoletaController;
<<<<<<< HEAD
use Illuminate\Support\Facades\Auth;
// No es necesario importar DashboardController aquí si lo usas en la función anónima.
// Si en el futuro creas un DashboardController para el admin, lo importarías aquí.
=======
// Asegúrate de que todas las clases usadas estén importadas aquí
// Por ejemplo, si usas UserProfile en alguna ruta comentada, deberías tener su 'use'
>>>>>>> 85c14eef84e259704571025b118ad81ff111bb3f

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
    
Route::middleware(['auth'])->group(function () {
    Route::get('/panel-administracion', function () {
        // VERIFICACIÓN DE ROL DIRECTA AQUÍ
        if (!Auth::check() || Auth::user()->role !== 'administrador') {
            abort(403, 'Acceso denegado. No tienes permisos de administrador.');
        }
        // Ahora retornamos la vista real
        return view('admin.panel'); // Asegúrate de que esta vista exista
    })->name('admin.panel');
});
    // Estas rutas de settings se asumen que ya existían y no tienen que ver con el perfil principal
    Route::redirect('settings', 'settings/profile');
    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');

    // La ruta del carrito - la hemos dejado si quieres que la página exista, solo ocultaste el enlace
    Volt::route('/carrito', 'shopping-cart')->name('cart.index');

    // Volt::route('/profile', UserProfile::class)->name('profile');
});

// **RUTAS ESPECÍFICAS PARA ADMINISTRADORES**
// Requieren autenticación Y el rol 'administrador'.
// El nombre de la ruta 'admin.panel' debe coincidir con la redirección en Login.blade.php

// **NUEVAS RUTAS ESPECÍFICAS PARA ADMINISTRADORES (SIN RoleMiddleware)**
// Requieren autenticación y la verificación del rol se hace DENTRO de la función.
// El nombre de la ruta 'admin.panel' debe coincidir con la redirección en login.blade.php
Route::middleware(['auth'])->group(function () { // Solo middleware 'auth'
    Route::get('/panel-administracion', function () {
        // VERIFICACIÓN DE ROL DIRECTA AQUÍ
        if (!Auth::check() || Auth::user()->role !== 'administrador') {
            abort(403, 'Acceso denegado. No tienes permisos de administrador.');
        }
        // Si el usuario es administrador, mostrará la vista o el contenido
        // return view('admin.panel'); // Usaremos esta vista en el siguiente paso
        return "<h1>¡Bienvenido al Panel de Administrador (Directo)!</h1><p>Solo para administradores.</p>";
    })->name('admin.panel');

    // Aquí podrías añadir más rutas de administración con verificación interna si es necesario


// Incluye las rutas de autenticación de Laravel Breeze/Jetstream
require __DIR__.'/auth.php';// <-- ¡IMPORTANTE: este es el nombre de la ruta!

    // Aquí podrías añadir más rutas de administración, por ejemplo, para gestionar productos:
    // Route::get('/productos', [AdminProductController::class, 'index'])->name('admin.products');
});

// Incluye las rutas de autenticación de Laravel Breeze/Jetstream
require __DIR__.'/auth.php';

<<<<<<< HEAD
// Rutas de Boleta
Route::get('/boleta', [BoletaController::class, 'show'])->name('boleta');
Route::post('/boleta', [BoletaController::class, 'store'])->name('boleta.store');
Route::post('/boleta/imprimir', [BoletaController::class, 'imprimirVoucher'])->name('boleta.imprimir');
Route::get('/boleta/pdf', [BoletaController::class, 'downloadPDF'])->name('boleta.pdf');
=======
Route::get('/boleta', [BoletaController::class, 'show'])->name('boleta');
Route::post('/boleta', [BoletaController::class, 'store'])->name('boleta.store');
Route::post('/boleta/imprimir', [BoletaController::class, 'imprimirVoucher'])->name('boleta.imprimir');
Route::get('/boleta/pdf', [BoletaController::class, 'downloadPDF'])->name('boleta.pdf');
>>>>>>> 85c14eef84e259704571025b118ad81ff111bb3f

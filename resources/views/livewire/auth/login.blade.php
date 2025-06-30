<?php

use Illuminate\Auth\Events\Lockout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Volt\Component;

new #[Layout('components.layouts.auth')] class extends Component {
    #[Validate('required|string|email')]
    public string $email = '';

    #[Validate('required|string')]
    public string $password = '';

    public bool $remember = false;

    public function login(): void
    {
        $this->validate();
        $this->ensureIsNotRateLimited();

        if (! Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember)) {
            RateLimiter::hit($this->throttleKey());
            throw ValidationException::withMessages([
                'email' => __('auth.failed'),
            ]);
        }

        RateLimiter::clear($this->throttleKey());
        Session::regenerate();

        // --- LÓGICA DE REDIRECCIÓN SIMPLIFICADA ---
        // Ahora, todos los usuarios autenticados (admin o cliente) irán al dashboard.
        $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);
        // --- FIN DE LA LÓGICA DE REDIRECCIÓN ---
    }

    protected function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout(request()));
        $seconds = RateLimiter::availableIn($this->throttleKey());
        throw ValidationException::withMessages([
            'email' => __('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    protected function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->email).'|'.request()->ip());
    }
}; ?>

{{-- Contenedor principal para centrar y aplicar fondo general --}}
<div class="flex items-center justify-center min-h-screen bg-[#FDFDFC] dark:bg-[#0a0a0a] p-4 sm:p-6">
    {{-- Tarjeta de login --}}
    <div class="flex flex-col items-center p-8 bg-white dark:bg-gray-800 rounded-lg shadow-xl w-full max-w-sm sm:max-w-lg mx-auto">

        {{-- Logo y Nombre de la Empresa --}}
        <div class="flex flex-col items-center text-center mb-6">
            <img src="{{ asset('images/logo-riccharly.png') }}" alt="Riccharly Huami Agropecuaria Logo" class="mx-auto mb-2 w-16 h-auto">
            <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-200">Riccharly Huami Agropecuaria</h2>
        </div>

        {{-- Título Iniciar Sesión --}}
        <h1 class="text-3xl font-extrabold mb-8 text-[#8B805C]">Iniciar Sesión</h1>

        {{-- Mensajes de estado (éxito/error) --}}
        <x-auth-session-status class="text-center mb-4 text-sm text-green-600 dark:text-green-400" :status="session('status')" />

        {{-- Formulario de Login --}}
        <form wire:submit="login" class="flex flex-col gap-5 w-full">
            <flux:input
                wire:model="email"
                :label="__('Correo Electrónico')"
                type="email"
                required
                autofocus
                autocomplete="username"
                placeholder="ejemplo@correo.com"
                class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-[#8B805C] focus:border-[#8B805C] dark:bg-gray-700 dark:text-gray-200 text-gray-800 placeholder-gray-400"
            />

            <div class="relative">
                <flux:input
                    wire:model="password"
                    :label="__('Contraseña')"
                    type="password"
                    required
                    autocomplete="current-password"
                    :placeholder="__('Ingrese su contraseña')"
                    viewable
                    class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-[#8B805C] focus:border-[#8B805C] dark:bg-gray-700 dark:text-gray-200 text-gray-800 placeholder-gray-400"
                />

                @if (Route::has('password.request'))
                    <flux:link class="absolute end-0 top-0 text-sm text-[#8B805C] hover:text-[#7a704e] no-underline hover:underline mt-1" :href="route('password.request')" wire:navigate>
                        {{ __('¿Olvidó su contraseña?') }}
                    </flux:link>
                @endif
            </div>

            <flux:checkbox
                wire:model="remember"
                :label="__('Recordar mi sesión')"
                class="text-[#8B805C] focus:ring-[#8B805C] dark:text-gray-300"
            />

            <div class="flex items-center justify-center mt-4">
                <flux:button variant="primary" type="submit" class="w-full bg-[#8B805C] hover:bg-[#7a704e] text-white py-3 px-4 rounded-md focus:outline-none focus:ring-2 focus:ring-[#8B805C] focus:ring-offset-2 focus:ring-offset-white dark:focus:ring-offset-gray-800 shadow-lg transition duration-300 ease-in-out">
                    {{ __('Iniciar Sesión') }}
                </flux:button>
            </div>
        </form>

        <div class="mt-8 text-center w-full">
            <hr class="border-t border-gray-200 dark:border-gray-700 my-6">
            <div class="space-x-1 rtl:space-x-reverse text-center text-base text-gray-600 dark:text-gray-400">
                {{ __('¿No tiene una cuenta?') }}
                @if (Route::has('register'))
                    <flux:link :href="route('register')" wire:navigate class="text-[#8B805C] hover:text-[#7a704e] font-semibold no-underline hover:underline">
                        {{ __('Registrarse') }}
                    </flux:link>
                @endif
            </div>
        </div>

        <div class="mt-6 flex justify-center gap-6 text-sm text-gray-600 dark:text-gray-400">
            <a href="{{ route('home') }}" class="hover:underline text-gray-600 dark:text-gray-400 hover:text-[#8B805C] dark:hover:text-[#a59a7c]">Inicio</a>
            <a href="{{ route('nosotros') ?? '#' }}" class="hover:underline text-gray-600 dark:text-gray-400 hover:text-[#8B805C] dark:hover:text-[#a59a7c]">Nosotros</a>
        </div>
    </div>
</div>
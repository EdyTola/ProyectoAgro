<?php

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('components.layouts.auth')] class extends Component {
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';

    public function register(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        $validated['password'] = Hash::make($validated['password']);
        event(new Registered(($user = User::create($validated))));
        Auth::login($user);
        $this->redirectIntended(route('dashboard', absolute: false), navigate: true);
    }
}; ?>

{{-- Contenedor principal para centrar y aplicar fondo general (igual que en el login) --}}
<div class="flex items-center justify-center min-h-screen bg-[#FDFDFC] dark:bg-[#0a0a0a] p-4 sm:p-6">
    {{-- Tarjeta de registro (igual que en el login) --}}
    <div class="flex flex-col items-center p-8 bg-white dark:bg-gray-800 rounded-lg shadow-xl w-full max-w-sm sm:max-w-lg mx-auto">

        {{-- Logo y Nombre de la Empresa (igual que en el login) --}}
        <div class="flex flex-col items-center text-center mb-6">
            <img src="{{ asset('images/logo-riccharly.png') }}" alt="Riccharly Huami Agropecuaria Logo" class="mx-auto mb-2 w-16 h-auto">
            <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-200">Riccharly Huami Agropecuaria</h2>
        </div>

        {{-- Título Registrar Cuenta --}}
        <h1 class="text-3xl font-extrabold mb-8 text-[#8B805C]">Registrar Cuenta</h1>

        {{-- Descripción del formulario --}}
        <p class="text-center text-gray-600 dark:text-gray-400 mb-6">Ingresa tus datos a continuación para crear tu cuenta.</p>

        <x-auth-session-status class="text-center mb-4 text-sm text-green-600 dark:text-green-400" :status="session('status')" />

        <form wire:submit="register" class="flex flex-col gap-5 w-full">
            <flux:input
                wire:model="name"
                :label="__('Nombre completo')"
                type="text"
                required
                autofocus
                autocomplete="name"
                :placeholder="__('Ingrese su nombre completo')"
                class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-[#8B805C] focus:border-[#8B805C] dark:bg-gray-700 dark:text-gray-200 text-gray-800 placeholder-gray-400"
            />

            <flux:input
                wire:model="email"
                :label="__('Correo electrónico')"
                type="email"
                required
                autocomplete="email"
                placeholder="correo@ejemplo.com"
                class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-[#8B805C] focus:border-[#8B805C] dark:bg-gray-700 dark:text-gray-200 text-gray-800 placeholder-gray-400"
            />

            <flux:input
                wire:model="password"
                :label="__('Contraseña')"
                type="password"
                required
                autocomplete="new-password"
                :placeholder="__('Ingrese su contraseña')"
                viewable
                class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-[#8B805C] focus:border-[#8B805C] dark:bg-gray-700 dark:text-gray-200 text-gray-800 placeholder-gray-400"
            />

            <flux:input
                wire:model="password_confirmation"
                :label="__('Confirmar contraseña')"
                type="password"
                required
                autocomplete="new-password"
                :placeholder="__('Confirme su contraseña')"
                viewable
                class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-[#8B805C] focus:border-[#8B805C] dark:bg-gray-700 dark:text-gray-200 text-gray-800 placeholder-gray-400"
            />

            <div class="flex items-center justify-center mt-4">
                <flux:button type="submit" variant="primary" class="w-full bg-[#8B805C] hover:bg-[#7a704e] text-white py-3 px-4 rounded-md focus:outline-none focus:ring-2 focus:ring-[#8B805C] focus:ring-offset-2 focus:ring-offset-white dark:focus:ring-offset-gray-800 shadow-lg transition duration-300 ease-in-out">
                    {{ __('Crear cuenta') }}
                </flux:button>
            </div>
        </form>

        <div class="mt-8 text-center w-full">
            <hr class="border-t border-gray-200 dark:border-gray-700 my-6">
            <div class="space-x-1 rtl:space-x-reverse text-center text-base text-gray-600 dark:text-gray-400">
                {{ __('¿Ya tienes una cuenta?') }}
                <flux:link :href="route('login')" wire:navigate class="text-[#8B805C] hover:text-[#7a704e] font-semibold no-underline hover:underline">
                    {{ __('Iniciar Sesión') }}
                </flux:link>
            </div>
        </div>

        <div class="mt-6 flex justify-center gap-6 text-sm text-gray-600 dark:text-gray-400">
            <a href="{{ route('home') }}" class="hover:underline text-gray-600 dark:text-gray-400 hover:text-[#8B805C] dark:hover:text-[#a59a7c]">Inicio</a>
            <a href="{{ route('nosotros') ?? '#' }}" class="hover:underline text-gray-600 dark:text-gray-400 hover:text-[#8B805C] dark:hover:text-[#a59a7c]">Nosotros</a>
        </div>
    </div>
</div>
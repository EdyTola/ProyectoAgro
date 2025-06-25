<?php

use Livewire\Volt\Component;

new class extends Component {
    //
}; ?>

<x-layouts.app :title="__('Mi Perfil')">
    <div class="p-6 bg-[#FDFDFC] dark:bg-[#0a0a0a] min-h-screen">
        <div class="max-w-4xl mx-auto bg-white dark:bg-gray-800 rounded-lg shadow-xl p-8 mt-10">

            <div class="flex items-center gap-6 mb-8 border-b border-gray-200 dark:border-gray-700 pb-6">
                {{-- Contenedor del Avatar/Logo --}}
                <div class="relative w-20 h-20 rounded-full bg-[#8B805C] flex items-center justify-center text-white text-3xl font-bold uppercase overflow-hidden shadow-md">
                    {{-- Avatar de iniciales --}}
                    @if ($user)
                        {{ substr($user->name, 0, 1) }}
                    @else
                        U {{-- Default si por alguna razón no hay usuario --}}
                    @endif
                </div>

                <div>
                    <h1 class="text-3xl font-bold text-gray-800 dark:text-gray-200 mb-1">
                        {{ $user->name ?? 'Usuario' }}
                    </h1>
                    <p class="text-lg text-gray-600 dark:text-gray-400">
                        {{ $user->email ?? 'correo@ejemplo.com' }}
                    </p>
                </div>
            </div>

            {{-- Sección de Información del Perfil --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-4 border-b pb-2 border-gray-200 dark:border-gray-700">Información General</h2>
                    <div class="space-y-4">
                        <div>
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Nombre de Usuario:</p>
                            <p class="text-lg text-gray-700 dark:text-gray-300">{{ $user->name ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Correo Electrónico:</p>
                            <p class="text-lg text-gray-700 dark:text-gray-300">{{ $user->email ?? 'N/A' }}</p>
                        </div>
                    </div>
                </div>

                <div>
                    <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-4 border-b pb-2 border-gray-200 dark:border-gray-700">Configuración</h2>
                    <div class="space-y-4">
                        <a href="{{ route('profile.edit') }}" class="block px-4 py-2 bg-[#8B805C] text-white rounded-md text-center hover:bg-[#7a704e] transition duration-300">
                            Editar Perfil (Nombre/Email)
                        </a>
                        <a href="{{ route('password.update') }}" class="block px-4 py-2 border border-[#8B805C] text-[#8B805C] rounded-md text-center hover:bg-[#8B805C] hover:text-white transition duration-300">
                            Cambiar Contraseña
                        </a>
                        <form method="POST" action="{{ route('logout') }}" class="block">
                            @csrf
                            <button type="submit" class="w-full px-4 py-2 bg-red-600 text-white rounded-md text-center hover:bg-red-700 transition duration-300">
                                Cerrar Sesión
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
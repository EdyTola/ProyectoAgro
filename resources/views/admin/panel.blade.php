<x-admin-layout> {{-- ¡Cambiado a x-admin-layout! --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Panel de Administración') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("¡Estás logueado como ADMINISTRADOR!") }}
                </div>
                <div class="p-6 text-gray-900">
                    <p>Contenido principal del panel de administración.</p>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
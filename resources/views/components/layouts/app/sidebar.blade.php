<div class="h-full py-4 px-3">
    <ul class="space-y-2 font-medium">
        @auth

            {{-- Elemento de navegación para "Inicio" (Dashboard) --}}
            <x-flux::navlist.item href="{{ route('dashboard') }}" :current="request()->routeIs('dashboard')" wire:navigate class="text-[#1b1b18] dark:text-white">
                <i class="fas fa-home mr-2 text-[#837227] dark:text-gray-400"></i> {{-- Icono de Font Awesome --}}
                {{ __('Inicio') }}
            </x-flux::navlist.item>

            {{-- Elemento de navegación para "Nosotros" --}}
            <x-flux::navlist.item href="{{ route('nosotros') }}" :current="request()->routeIs('nosotros')" wire:navigate class="text-[#1b1b18] dark:text-white">
                <i class="fas fa-users mr-2 text-[#837227] dark:text-gray-400"></i> {{-- Icono de Font Awesome --}}
                {{ __('Nosotros') }}
            </x-flux::navlist.item>

            {{-- Elemento de navegación para "Catálogo" --}}
            <x-flux::navlist.item href="{{ route('catalogo') }}" :current="request()->routeIs('catalogo')" wire:navigate class="text-[#1b1b18] dark:text-white">
                <i class="fas fa-book-open mr-2 text-[#837227] dark:text-gray-400"></i> {{-- Icono de Font Awesome --}}
                {{ __('Catálogo') }}
            </x-flux::navlist.item>

            {{-- Elemento de navegación para "Carrito" --}}
            {{-- Nota: Asegúrate de que la ruta 'carrito' esté definida en routes/web.php --}}
            <x-flux::navlist.item href="{{ route('cart.index') ?? '#' }}" :current="request()->routeIs('cart.index')" wire:navigate class="text-[#1b1b18] dark:text-white">
                <i class="fas fa-shopping-cart mr-2 text-[#837227] dark:text-gray-400"></i> {{-- Icono de Font Awesome --}}
                {{ __('Carrito') }}
            </x-flux::navlist.item>

            {{-- Elemento de navegación para "Contactos" --}}
            <x-flux::navlist.item href="{{ route('contactos') }}" :current="request()->routeIs('contactos')" wire:navigate class="text-[#1b1b18] dark:text-white">
                <i class="fas fa-envelope mr-2 text-[#837227] dark:text-gray-400"></i> {{-- Icono de Font Awesome --}}
                {{ __('Contactos') }}
            </x-flux::navlist.item>

            {{-- Elemento de navegación para "Boleta" --}}
            {{-- Nota: Asegúrate de que la ruta 'boleta' esté definida en routes/web.php --}}
            <x-flux::navlist.item href="{{ route('boleta') ?? '#' }}" :current="request()->routeIs('boleta')" wire:navigate class="text-[#1b1b18] dark:text-white">
                <i class="fas fa-file-invoice mr-2 text-[#837227] dark:text-gray-400"></i> {{-- Icono de Font Awesome --}}
                {{ __('Boleta') }}
            </x-flux::navlist.item>
        @endauth
    </ul>
</div>
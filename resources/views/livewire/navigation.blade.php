{{-- Ejemplo de enlace en la navegación --}}
<a href="{{ route('profile') }}" class="flex items-center text-gray-600 dark:text-gray-300 hover:text-[#8B805C] dark:hover:text-[#a59a7c] px-4 py-2 rounded-md transition duration-200">
    {{-- Pequeño avatar en la navegación --}}
    <div class="w-6 h-6 rounded-full bg-[#8B805C] text-white text-xs flex items-center justify-center uppercase mr-2">
        {{ substr(Auth::user()->name, 0, 1) }}
    </div>
    Mi Perfil
</a>
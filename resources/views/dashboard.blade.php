<x-layouts.app :title="__('Inicio')">
    {{-- Contenido Principal (Agropecuaria Riccharly Huami y botones) --}}
    <div class="flex flex-col items-center p-6">
        <div class="text-center bg-transparent p-6 rounded-lg max-w-2xl">
            <h1 class="text-4xl md:text-5xl font-bold text-gray-800 dark:text-gray-200 mb-4">Agropecuaria Riccharly Huami</h1>
            <p class="text-lg text-gray-600 dark:text-gray-400 mb-8">
                Productos agrícolas y ganaderos de la más alta calidad en Puno, Perú. Tradición y excelencia desde 1945.
            </p>
            <div class="flex justify-center gap-4">
                <a href="/catalogo" class="px-6 py-3 bg-[#8B805C] hover:bg-[#7a704e] text-white font-semibold rounded-md shadow-md transition duration-300">
                    Ver catálogo
                </a>
                <a href="{{ route('contactos') }}" class="px-6 py-3 border border-[#8B805C] text-[#8B805C] hover:bg-[#8B805C] hover:text-white font-semibold rounded-md shadow-md transition duration-300">
                    Contacto
                </a>
            </div>
        </div>
    </div>
</x-layouts.app>
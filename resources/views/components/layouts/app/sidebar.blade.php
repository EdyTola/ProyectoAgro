{{-- resources/views/components/layouts/app/sidebar.blade.php --}}
<div class="h-full py-4 px-3">
    

    <ul class="space-y-2 font-medium">
        <li>
            <a href="{{ route('home') }}" class="flex items-center p-2 text-base font-normal rounded-lg text-[#1b1b18] dark:text-white hover:bg-[#F7F6F3] dark:hover:bg-gray-700">
                {{-- Icono de Inicio --}}
                <svg class="w-6 h-6 text-[#837227] dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path></svg>
                <span class="ml-3">Inicio</span>
            </a>
        </li>
        {{-- ELIMINADO: Dashboard --}}
        <li>
            <a href="{{ route('nosotros') }}" class="flex items-center p-2 text-base font-normal rounded-lg text-[#1b1b18] dark:text-white hover:bg-[#F7F6F3] dark:hover:bg-gray-700 {{ Request::routeIs('nosotros') ? 'bg-[#F7F6F3] dark:bg-gray-700' : '' }}">
                {{-- Icono de Nosotros (personas) --}}
                <svg class="flex-shrink-0 w-6 h-6 text-[#837227] dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"></path></svg>
                <span class="ml-3">Nosotros</span>
            </a>
        </li>
        <li>
            <a href="/catalogo" class="flex items-center p-2 text-base font-normal rounded-lg text-[#1b1b18] dark:text-white hover:bg-[#F7F6F3] dark:hover:bg-gray-700">
                {{-- Icono de Catálogo (planta/flor) --}}
                <svg class="flex-shrink-0 w-6 h-6 text-[#837227] dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3 5a2 2 0 012-2h10a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2V5zm1.5 5.5a1.5 1.5 0 110-3 1.5 1.5 0 010 3zm6 .5a.5.5 0 00-1 0v3a.5.5 0 001 0V11z" clip-rule="evenodd"></path></svg>
                <span class="ml-3">Catálogo</span>
            </a>
        </li>
        <li>
            <a href="/carrito" class="flex items-center p-2 text-base font-normal rounded-lg text-[#1b1b18] dark:text-white hover:bg-[#F7F6F3] dark:hover:bg-gray-700">
                {{-- Icono de Carrito --}}
                <svg class="flex-shrink-0 w-6 h-6 text-[#837227] dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z"></path></svg>
                <span class="ml-3">Carrito</span>
            </a>
        </li>
        <li>
            <a href="{{ route('contactos') }}" class="flex items-center p-2 text-base font-normal rounded-lg text-[#1b1b18] dark:text-white hover:bg-[#F7F6F3] dark:hover:bg-gray-700 {{ Request::routeIs('contactos') ? 'bg-[#F7F6F3] dark:bg-gray-700' : '' }}">
                {{-- Icono de Contactos (correo) --}}
                <svg class="flex-shrink-0 w-6 h-6 text-[#837227] dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path><path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path></svg>
                <span class="ml-3">Contactos</span>
            </a>
        </li>
        <li>
            <a href="/boleta" class="flex items-center p-2 text-base font-normal rounded-lg text-[#1b1b18] dark:text-white hover:bg-[#F7F6F3] dark:hover:bg-gray-700">
                {{-- Icono de Boleta --}}
                <svg class="flex-shrink-0 w-6 h-6 text-[#837227] dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V4a2 2 0 00-2-2H6zm0 2h8v12H6V4zm2 2v2h4V6H8zm0 4v2h4v-2H8z"/>
                </svg>
                <span class="ml-3">Boleta</span>
            </a>
        </li>
        @guest
            <li>
                <a href="{{ route('login') }}" class="flex items-center p-2 text-base font-normal rounded-lg text-[#1b1b18] dark:text-white hover:bg-[#F7F6F3] dark:hover:bg-gray-700 {{ Request::routeIs('login') ? 'bg-[#F7F6F3] dark:bg-gray-700' : '' }}">
                    {{-- Icono de Iniciar Sesión --}}
                    <svg class="flex-shrink-0 w-6 h-6 text-[#837227] dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3 3a1 1 0 00-1 1v12a1 1 0 001 1h12a1 1 0 001-1V4a1 1 0 00-1-1H3zm0 14V5a1 1 0 011-1h12a1 1 0 011 1v12a1 1 0 01-1 1H4a1 1 0 01-1-1zm6-6H5a1 1 0 000 2h4a1 1 0 000-2zm5-2H5a1 1 0 000 2h10a1 1 0 000-2zm0-2H5a1 1 0 000 2h10a1 1 0 000-2z" clip-rule="evenodd"></path></svg>
                    <span class="ml-3">Iniciar Sesión</span>
                </a>
            </li>
        @endguest
    </ul>
</div>

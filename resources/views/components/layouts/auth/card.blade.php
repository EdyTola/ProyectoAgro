<!DOCTYPE html>
{{-- Aseguramos que la página use el modo "light" de Tailwind --}}
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="light">
    <head>
        @include('partials.head')
    </head>
    {{-- Color de fondo principal: F7F6F3 --}}
    <body class="min-h-screen bg-[#F7F6F3] antialiased">
        <div class="bg-muted flex min-h-svh flex-col items-center justify-center p-6 md:p-10">
            <div class="flex w-full max-w-md flex-col gap-6">
                <a href="{{ route('home') }}" class="flex flex-col items-center gap-2 font-medium" wire:navigate>
                    <span class="flex h-9 w-9 items-center justify-center rounded-md">
                        {{-- Asegúrate de que tu logo sea visible en un fondo claro --}}
                        <img src="{{ asset('images/logo-riccharly.png') }}" alt="Riccharly Huami Logo" class="size-9" />
                    </span>

                    <span class="sr-only">{{ config('app.name', 'Laravel') }}</span>
                </a>

                <div class="flex flex-col gap-6">
                    {{-- Fondo de la tarjeta de login: blanco, con borde sutil --}}
                    {{-- Eliminamos cualquier clase 'dark:' aquí para forzar el estilo claro --}}
                    <div class="rounded-xl border border-zinc-200 bg-white text-stone-800 shadow-xs">
                        <div class="px-10 py-8">{{ $slot }}</div>
                    </div>
                </div>
            </div>
        </div>
        @fluxScripts
    </body>
</html>
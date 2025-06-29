@props([
    'title',
    'description',
])

<div {{ $attributes->merge(['class' => 'flex flex-col text-center']) }}>
    {{-- Agregamos el logo y el nombre de la empresa aquí --}}
    <img src="{{ asset('images/logo-riccharly.png') }}" alt="Riccharly Huami Agropecuaria Logo" class="mx-auto mb-2" style="width: 50px; height: auto;">
    <h2 class="text-xl font-semibold text-[#1b1b18] mb-6">Riccharly Huami Agropecuaria</h2> {{-- Ajustado el margen inferior --}}

    {{-- Los títulos y descripciones pasados al componente --}}
    @isset($title)
        {{-- Aplicamos el color de texto del diseño, asegurando que se vea bien en fondo claro --}}
        <h1 class="text-2xl font-bold mb-2 text-[#1b1b18]">{{ $title }}</h1> {{-- Eliminado dark:text y ajustado margen inferior --}}
    @endisset

    @isset($description)
        {{-- Aplicamos el color de texto del diseño --}}
        <p class="text-zinc-600">{{ $description }}</p> {{-- Eliminado dark:text --}}
    @endisset
</div>
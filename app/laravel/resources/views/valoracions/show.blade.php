<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ver Tarjeta') }}
        </h2>
    </x-slot>

    <div class="grid grid-cols-2 gap-8 mx-auto max-w-7xl">

        {{-- Basic Info --}}
        <div class="flex flex-col gap-3">

            <a href="{{ url()->previous() }}">&larr; Tornar</a>

            <div class="space-y-5">

                {{-- Datos de la valoracion --}}

                {{-- Nom --}}
                <div class="leading-4 mb-5">
                    <h1 class="text-5xl font-bold">{{ $valoracio->client->nom }} {{ $valoracio->client->cognom }}</h1>
                </div>

                {{-- Comentari --}}
                <div>
                    <p class="text-sm text-zinc-500 font-medium">Comentario</p>
                    <p class="text-lg">{{ $valoracio->descripcio }}</p>
                </div>

                {{-- Classe --}}
                <div>
                    <p class="text-sm text-zinc-500 font-medium">Clase</p>
                    <p class="text-lg">{{ $valoracio->classe->tipus }}, Sala {{ $valoracio->classe->sala->id }},
                        {{ \Carbon\Carbon::parse($valoracio->classe->dia)->format('d/m/Y') }},
                        {{ $valoracio->classe->horari_inici }} - {{ $valoracio->classe->horari_final }}</p>
                </div>

                {{-- Estrelles --}}
                <div>
                    <p class="text-sm text-zinc-500 font-medium">Estrellas</p>
                    @for ($i = 1; $i <= 5; $i++)
                        @if ($i <= $valoracio->estrelles)
                            <span class="text-lg text-yellow-400">★</span>
                        @else
                            <span class="text-lg text-gray-600">☆</span>
                        @endif
                    @endfor
                </div>

                {{-- Només es mostra Acciones si es ADMIN o CLIENT --}}
                <div class="flex gap-2 items-center mt-5">
                    @if ($user->rol == 'ADMIN')
                        <a href="{{ route('valoracions.edit', $valoracio) }}"
                            class="rounded hover:bg-blue-500 hover:text-white transition border border-blue-500 px-5 py-1.5">
                            Editar
                        </a>
                    @endif

                    @if ($user->rol !== 'MONITOR')
                        <form action="{{ route('valoracions.destroy', $valoracio) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('¿Estás seguro de que quieres eliminar esta valoración?')"
                                class="cursor-pointer rounded hover:bg-red-500 hover:text-white transition border border-red-500 px-5 py-1.5">Eliminar</button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
</x-app-layout>

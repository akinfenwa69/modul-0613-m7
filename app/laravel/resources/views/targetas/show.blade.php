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

                {{-- Precio y tipo --}}
                <div class="leading-4 mb-5">
                    <h2 class="text-3xl text-gray-600">{{ $targeta->nom_titular }}</h2>
                    <h1 class="text-5xl font-bold">{{ $targeta->numero_compte }}</h1>
                </div>

                {{-- Fecha --}}
                <div>
                    <p class="text-sm text-zinc-500 font-medium">Fecha de validación</p>
                    <p class="text-lg">
                        {{ \Carbon\Carbon::parse($targeta->data_validesa)->format('d/m/Y') }}
                    </p>
                </div>

                {{-- CVV --}}
                <div>
                    <p class="text-sm text-zinc-500 font-medium">CVV</p>
                    <p class="text-lg">{{ $targeta->cvv }}</p>
                </div>

                {{-- Tipus targeta --}}
                <div>
                    <p class="text-sm text-zinc-500 font-medium">Tipo de tarjeta</p>
                    <p class="text-lg">{{ $targeta->tipus_targeta }}</p>
                </div>

                {{-- Usuari --}}
                <div>
                    <p class="text-sm text-zinc-500 font-medium">Usuario</p>
                    <span class="text-lg font-medium">{{ $targeta->client->nom }} {{ $targeta->client->cognom }}</span>
                </div>

                {{-- Estat --}}
                <div>
                    <p class="text-sm text-zinc-500 font-medium">Estado</p>
                    <span class="text-lg font-medium {{ $targeta->activa ? 'text-green-600' : 'text-red-500' }}">
                        {{ $targeta->activa ? 'Activa' : 'Inactiva' }}
                    </span>
                </div>

            </div>

            {{-- Només es mostra Acciones si es ADMIN o CLIENT --}}

            <div class="flex gap-2 items-center mt-5">
                <a href="{{ route('targetas.edit', $targeta) }}"
                    class="rounded hover:bg-blue-500 hover:text-white transition border border-blue-500 px-5 py-1.5">
                    Editar
                </a>

                @if ($user->rol !== 'CLIENT')
                    <form action="{{ route('targetas.destroy', $targeta) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            onclick="return confirm('¿Estás seguro de que quieres eliminar esta tarjeta?')"          
                            class="cursor-pointer rounded hover:bg-red-500 hover:text-white transition border border-red-500 px-5 py-1.5">
                            Eliminar
                        </button>
                    </form>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>

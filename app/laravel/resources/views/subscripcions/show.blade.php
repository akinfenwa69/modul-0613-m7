<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ver Suscripción') }}
        </h2>
    </x-slot>

    <div class="grid grid-cols-2 gap-8 mx-auto max-w-7xl">

        {{-- Basic Info --}}
        <div class="flex flex-col gap-3">

            <a href="{{ url()->previous() }}">&larr; Volver</a>

            <div class="space-y-5">

                {{-- Precio y tipo --}}
                <div class="leading-4 mb-5">
                    <h2 class="text-3xl text-green-600 font-semibold">{{ $subscripcio->preu }} €</h2>
                    <h1 class="text-5xl font-bold">Suscripcion {{ $subscripcio->tipus }}</h1>
                </div>

                {{-- Fecha --}}
                <div>
                    <p class="text-sm text-zinc-500 font-medium">Fecha de vencimiento</p>
                    <p class="text-lg">
                        {{ \Carbon\Carbon::parse($subscripcio->data_inici)->format('d/m/Y') }} &mdash;
                        {{ \Carbon\Carbon::parse($subscripcio->data_fi)->format('d/m/Y') }}
                    </p>
                </div>

                {{-- Usuario --}}
                <div>
                    <p class="text-sm text-zinc-500 font-medium">Usuario</p>
                    <span class="text-lg font-medium">{{ $subscripcio->client->nom }}
                        {{ $subscripcio->client->cognom }}</span>
                </div>

                {{-- Estado --}}
                <div>
                    <p class="text-sm text-zinc-500 font-medium">Estado</p>
                    <span
                        class="text-lg font-medium {{ \Carbon\Carbon::now()->between($subscripcio->data_inici, $subscripcio->data_fi) ? 'text-green-600' : 'text-red-500' }}">
                        {{ \Carbon\Carbon::now()->between($subscripcio->data_inici, $subscripcio->data_fi) ? 'Activa' : 'Caducada' }}
                    </span>
                </div>

                {{-- Descripción opcional --}}
                @if (!empty($subscripcio->descripcio))
                    <div>
                        <p class="text-sm text-zinc-500 font-medium">Descripció</p>
                        <p class="text-zinc-700">{{ $subscripcio->descripcio }}</p>
                    </div>
                @endif

            </div>

            {{-- Només es mostra Acciones si es ADMIN o CLIENT --}}
            @if ($user->rol !== 'CLIENT')
                <div class="flex gap-2 items-center mt-5">
                    <a href="{{ route('subscripcions.edit', $subscripcio) }}"
                        class="rounded hover:bg-blue-500 hover:text-white transition border border-blue-500 px-5 py-1.5">
                        Editar
                    </a>
                    <form action="{{ route('subscripcions.destroy', $subscripcio) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            onclick="return confirm('¿Estás seguro de que quieres eliminar esta suscripción?')"
                            class="cursor-pointer rounded hover:bg-red-500 hover:text-white transition border border-red-500 px-5 py-1.5">
                            Eliminar
                        </button>
                    </form>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>

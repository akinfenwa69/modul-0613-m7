<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ver Reserva') }}
        </h2>
    </x-slot>

    <div class="flex flex-col gap-3">
        <a href="{{ url()->previous() }}">&larr; Volver</a>
        <h1 class="text-3xl text-medium">Reserva de {{ $reserva->client->nom ?? 'Cliente eliminado' }} {{ $reserva->client->cognom ?? '' }}</h1>
        <p>Fecha de reserva: {{ $reserva->data_de_reserva }}</p>

        <div class="flex gap-2">

            <div class="flex items-center gap-2">
                <p>Clase:</p>

                @if ($reserva->classe)
                    <a href="{{ route('classes.show', $reserva->classe) }}"
                    class="px-3 py-1 rounded border border-zinc-300 hover:bg-zinc-200 transition">
                        Clase de {{ $reserva->classe->tipus }}
                    </a>
                @else
                    <span class="text-zinc-500">Sin clase</span>
                @endif
            </div>

            <div class="flex items-center gap-2">
                <p>Client:</p>

                @if ($reserva->client)

                    @if ($user->rol === 'ADMIN')
                        <a href="{{ route('usuaris.show', $reserva->client) }}"
                        class="px-3 py-1 rounded border border-zinc-300 hover:bg-zinc-200 transition">
                            {{ $reserva->client->nom }} {{ $reserva->client->cognom }}
                        </a>
                    @else
                        <p>
                            {{ $reserva->client->nom }} {{ $reserva->client->cognom }}
                        </p>
                    @endif

                @else
                    <span class="text-zinc-500">Sin cliente</span>
                @endif
            </div>
        </div>

        {{-- Acciones --}}
        @if ($user->rol == 'ADMIN')
            <div class="mt-5 flex flex-row gap-2">

                <a href="{{ route('reserves.edit', $reserva->id) }}"
                class="rounded hover:bg-blue-500 hover:text-white transition border border-blue-500 px-5 py-1.5">
                    Editar
                </a>

                <form action="{{ route('reserves.destroy', $reserva->id) }}" method="POST">
                    @csrf
                    @method('DELETE')

                    <button type="submit"
                        onclick="return confirm('¿Estás seguro de que quieres eliminar esta reserva?')"
                        class="cursor-pointer rounded hover:bg-red-500 hover:text-white transition border border-red-500 px-5 py-1.5">
                        Eliminar
                    </button>
                </form>

            </div>
        @endif

    </div>
</x-app-layout>

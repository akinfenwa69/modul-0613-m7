<x-app-layout>


    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tarjetas') }}
        </h2>
    </x-slot>

    @php
        $user = Auth::user();
    @endphp

    <div class="flex flex-col gap-3">

        <a href="{{ route('targetas.create') }}"
            class="rounded w-fit text-lg transition! hover:scale-105! bg-blue-300 hover:bg-blue-400 px-12 py-1.5">
            + Agregar
        </a>

        <div class="grid grid-cols-1 md:grid-cols-2! xl:grid-cols-3! gap-5">
            @if (count($targetas) > 0)
                @foreach ($targetas as $t)
                    <div class="relative overflow-hidden bg-[#eee] rounded-xl border border-zinc-300! px-5 py-3 flex flex-col gap-3 transition! hover:scale-105!">

                        {{-- Parte clickeable para ver la tarjeta --}}
                        <a href="{{ route('targetas.show', $t) }}" class="block">
                            <div class="flex justify-between mb-2">
                                <div>
                                    <p class="text-lg">{{ $t->tipus_targeta }}</p>
                                    @if ($user->rol !== 'CLIENT')
                                        <p class="text-sm text-zinc-500">{{ $t->client->nom }} {{ $t->client->cognom }}</p>
                                    @endif
                                </div>
                                <span class="px-3 py-1 flex w-fit h-fit rounded text-sm {{ $t->activa ? 'bg-green-500' : 'bg-zinc-400' }}">
                                    {{ $t->activa ? 'Activa' : 'Inactiva' }}
                                </span>
                            </div>

                            <p class="font-mono text-xl lg:text-2xl! 2xl:text-3xl! tracking-widest font-bold mb-2">
                                {{ $t->numero_compte }}
                            </p>

                            <div class="flex items-center justify-between text-sm text-zinc-500">
                                <p>{{ $t->nom_titular }}</p>
                                <p>{{ \Carbon\Carbon::parse($t->data_validesa)->format('d/m/Y') }}</p>
                                <p>{{ $t->cvv }}</p>
                            </div>
                        </a>

                        {{-- Botones según rol --}}
                        @if ($user->rol === 'CLIENT')
                            {{-- Cliente: solo ver "Editar", ocupa toda la línea --}}
                            <a href="{{ route('targetas.edit', $t) }}" onclick="event.stopPropagation();"
                            class="block w-full text-center px-3 py-1 border border-zinc-400! text-black bg-white rounded transition hover:bg-blue-500 hover:text-white mt-2">
                                Editar
                            </a>
                        @else
                            {{-- ADMIN / MONITOR: editar + eliminar en la misma línea --}}
                            <div class="grid grid-cols-2 gap-2 mt-2">
                                <a href="{{ route('targetas.edit', $t) }}" onclick="event.stopPropagation();"
                                class="text-center px-3 py-1 border border-zinc-400! text-black bg-white rounded transition hover:bg-blue-500 hover:text-white">
                                    Editar
                                </a>

                                <form action="{{ route('targetas.destroy', $t) }}" method="POST" onclick="event.stopPropagation();">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="w-full cursor-pointer px-3 py-1 border border-zinc-400! text-black bg-white rounded transition hover:bg-red-500 hover:text-white!"
                                            onclick="return confirm('¿Estás seguro de que quieres eliminar esta tarjeta?')">
                                        Eliminar
                                    </button>
                                </form>
                            </div>
                        @endif

                    </div>
                @endforeach
            @else
                <span>No tienes ninguna tarjeta!</span>
            @endif
        </div>
    </div>
</x-app-layout>

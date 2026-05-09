<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Reservas') }}
        </h2>
    </x-slot>

    @php
        $user = Auth::user();
    @endphp

    <div class="flex flex-col gap-3">
        {{-- Botó per crear reservas --}}
        @if ($user->rol === 'ADMIN')
            <a href="{{ route('reserves.create') }}"
                class="text-lg bg-blue-300 hover:bg-blue-400 px-12 py-1.5 w-fit rounded transition! hover:scale-105!">
                + Agregar
            </a>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2! lg:grid-cols-3! xl:grid-cols-4! gap-5">
            @if (count($reserves) > 0)
                @foreach ($reserves as $r)
                    <div class="relative bg-[#eee] flex flex-col overflow-hidden gap-3 border border-zinc-300! px-5 py-3 rounded-xl transition! hover:scale-105!" onclick="window.location='{{ route('reserves.show', $r) }}'">

                            <div>
                                @if ($user->rol !== 'CLIENT')
                                    <p class="text-sm text-zinc-500">
                                        {{ $r->client->nom }} {{ $r->client->cognom }}
                                    </p>
                                @endif
                                <p class="text-xl font-bold">
                                    {{ \Carbon\Carbon::parse($r->data_de_reserva)->format('d/m/Y, H:i') }}</p>
                            </div>
                            @if (Auth::user()->rol !== 'CLIENT')
                                <button type="button" onclick="event.preventDefault(); event.stopPropagation(); openClasseModal({{ $r->classe->id }})"
                                    class="relative z-20 border border-zinc-300 hover:bg-zinc-200 transition px-4 py-2 rounded-lg cursor-pointer text-left">
                                    <p class="font-medium text-lg">{{ $r->classe?->tipus ?? 'Clase eliminada' }}, Sala {{ $r->classe?->sala?->id ?? '-' }}</p>
                                    <p>
                                        {{ \Carbon\Carbon::parse($r->classe->dia)->format('d/m/Y') }},
                                        {{ \Carbon\Carbon::parse($r->classe->horari_inici)->format('H:i') }}-{{ \Carbon\Carbon::parse($r->classe->horari_final)->format('H:i') }}
                                    </p>
                                    <p class="text-xs text-zinc-500">{{ $r->classe->descripcio }}</p>
                                </button>
                            @else
                                <button type="button" onclick="event.preventDefault(); event.stopPropagation(); openClasseModal({{ $r->classe->id }})"
                                    class="relative z-20 border border-zinc-300 hover:bg-zinc-200 transition px-4 py-2 rounded-lg cursor-pointer text-left">
                                    <p class="font-medium text-lg">{{ $r->classe->tipus }}, Sala {{ $r->classe->sala->id }}</p>
                                    <p class="text-sm text-zinc-500">
                                        {{ \Carbon\Carbon::parse($r->classe->dia)->format('d/m/Y') }},
                                        {{ \Carbon\Carbon::parse($r->classe->horari_inici)->format('H:i') }}-{{ \Carbon\Carbon::parse($r->classe->horari_final)->format('H:i') }}
                                    </p>
                                </button>

                            @endif


                            {{-- Només es mostra Acciones si es ADMIN o CLIENT --}}
                            @if ($user->rol !== 'MONITOR')
                                <div
                                    class="relative z-20 grid {{ $user->rol === 'ADMIN' ? 'grid-cols-2' : 'grid-cols-1' }} gap-2">

                                    {{-- ADMIN puede editar --}}
                                    @if ($user->rol === 'ADMIN') 
                                        <a href="{{ route('reserves.edit', $r) }}" onclick="event.stopPropagation();"
                                            class="text-center px-3 py-1 border border-zinc-400! text-black bg-white rounded transition hover:bg-blue-500 hover:text-white">
                                            Editar
                                        </a>
                                    @endif

                                    {{-- ADMIN y CLIENT pueden eliminar --}}
                                    <form action="{{ route('reserves.destroy', $r) }}" method="POST" onclick="event.stopPropagation();">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="w-full cursor-pointer px-3 py-1 border border-zinc-400 text-black bg-white rounded transition hover:bg-red-500 hover:text-white"
                                            onclick="return confirm('¿Estás seguro de que quieres eliminar esta reserva?')">
                                            Eliminar
                                        </button>
                                    </form>

                                </div>
                            @endif
                    </div>
                @endforeach
            @else
                <span>No tienes ninguna reserva!</span>
            @endif
        </div>
    </div>
</x-app-layout>

<div id="modal-container"></div>

<script>
    function openClasseModal(classeId) {
        fetch(`/classes/modal/${classeId}`)
            .then(response => response.text())
            .then(html => {
                document.getElementById('modal-container').innerHTML = html;
            });
    }
</script>

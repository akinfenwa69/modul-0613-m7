<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Valoraciones') }}
        </h2>
    </x-slot>

    @php
        $user = Auth::user();
    @endphp

    <div class="relative flex flex-col gap-3">

        {{-- Botó per crear valoracions (Només CLIENT i ADMIN) --}}
        @if ($user->rol !== 'MONITOR')
            <a href="{{ route('valoracions.create') }}"
                class="w-fit rounded text-lg transition! hover:scale-105! bg-blue-300 hover:bg-blue-400 px-12 py-1.5">
                + Agregar
            </a>
        @endif


        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-5">

            @forelse ($valoracions as $v)

                <div class="overflow-hidden bg-[#eee] relative border border-zinc-300 rounded-xl px-7 py-5 flex flex-col gap-3 transition hover:scale-105"
                    onclick="window.location='{{ route('valoracions.show', $v) }}'">

                    {{-- CLIENTE --}}
                    <div>
                        <div class="flex items-center gap-3 mb-2">

                            <span class="p-2! bg-linear-to-br from-purple-500 to-blue-400 rounded-full h-9 w-9 flex items-center justify-center text-white font-bold text-xl uppercase">{{ mb_substr($v->client->nom ?? '', 0, 1) }}</span>

                            <div class="flex flex-col leading-3">
                                <p class="font-semibold">
                                    {{ $v->client->nom ?? 'Sin nombre' }}
                                    {{ $v->client->cognom ?? '' }}
                                </p>
                            </div>

                        </div>

                        {{-- ESTRELLAS --}}
                        <div class="flex items-center gap-1">
                            @php
                                $max = 5;
                                $filled = (int) $v->estrelles;
                                $empty = $max - $filled;
                            @endphp

                            @for ($i = 0; $i < $filled; $i++)
                                <span class="text-yellow-400 text-lg">★</span>
                            @endfor

                            @for ($i = 0; $i < $empty; $i++)
                                <span class="text-gray-300 text-lg">★</span>
                            @endfor

                            <span class="text-xs text-zinc-500 ml-1">
                                ({{ $v->estrelles }}/5)
                            </span>
                        </div>
                    </div>

                    {{-- DESCRIPCIÓN --}}
                    <div>
                        <p class="text-sm text-zinc-700">
                            {{ $v->descripcio }}
                        </p>
                    </div>

                    {{-- CLASE --}}
                    <button type="button"
                        onclick="event.stopPropagation(); openClasseModal({{ $v->classe->id }})"
                        class="flex items-center justify-between text-xs text-zinc-600 relative z-20 border border-zinc-300 rounded px-3 py-2 hover:bg-zinc-200 transition cursor-pointer">

                        <span>
                            {{ $v->classe->tipus ?? 'Clase' }},
                            Sala {{ $v->classe->sala->id ?? '?' }}
                        </span>

                        <span>
                            {{ \Carbon\Carbon::parse($v->classe->dia)->format('d/m/Y') }},
                            {{ \Carbon\Carbon::parse($v->classe->horari_inici)->format('H:i') }}
                            -
                            {{ \Carbon\Carbon::parse($v->classe->horari_final)->format('H:i') }}
                        </span>

                    </button>

                    {{-- ACCIONES --}}
                    <div class="relative z-20 flex gap-2">

                        {{-- EDITAR (solo ADMIN) --}}
                        @if ($user->rol === 'ADMIN')
                            <a href="{{ route('valoracions.edit', $v) }}"
                                onclick="event.stopPropagation();"
                                class="flex-1 text-center px-3 py-1 border border-gray-400 text-black bg-white rounded transition hover:bg-blue-500 hover:text-white">
                                Editar
                            </a>
                        @endif

                        {{-- ELIMINAR (ADMIN + CLIENT, menos MONITOR) --}}
                        @if ($user->rol !== 'MONITOR')
                            <form action="{{ route('valoracions.destroy', $v) }}" method="POST"
                                class="flex-1" onclick="event.stopPropagation();">
                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                    class="w-full px-3 py-1 border border-gray-400 text-black bg-white rounded transition hover:bg-red-500 hover:text-white"
                                    onclick="return confirm('¿Estás seguro de que quieres eliminar esta valoración?')">
                                    Eliminar
                                </button>
                            </form>
                        @endif

                    </div>

                </div>

            @empty

                <p class="text-zinc-500">No hay valoraciones todavía.</p>

            @endforelse

        </div>

        {{-- PAGINACIÓN SOLO SI ES PAGINATE --}}
        @if ($valoracions instanceof \Illuminate\Pagination\LengthAwarePaginator)
            <div class="mt-6">
                {{ $valoracions->links() }}
            </div>
        @endif

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

<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ver Clase') }}
        </h2>
    </x-slot>

    @php
        $ocupacio = $classe->reserves->count();
    @endphp

    <div class="flex flex-col lg:flex-row gap-6">

        {{-- 🔹 IZQUIERDA: INFO CLASE --}}
        <div class="w-full lg:w-2/5 flex flex-col gap-4">

            <a href="{{ url()->previous() }}">&larr; Volver</a>

            <div>
                <div class="flex items-center gap-2">
                    <p class="text-3xl">Clase de {{ $classe->tipus }}</p>
                </div>

                <img src="{{ '/images/sala_' . Str::lower(Str::replace(' ', '_', $classe->tipus)) . '.jpeg' }}"
                    alt="{{ $classe->tipus }}"
                    class="mt-3 mb-3 h-50 w-100 rounded-lg object-cover bg-zinc-200 border border-zinc-300">


                <p class="text-sm text-zinc-500">
                    {{ \Carbon\Carbon::parse($classe->dia)->format('d/m/Y') }}
                    &mdash;
                    {{ \Carbon\Carbon::parse($classe->horari_inici)->format('H:i') }} -
                    {{ \Carbon\Carbon::parse($classe->horari_final)->format('H:i') }}
                </p>
            </div>

            <p class="text-zinc-700">{{ $classe->descripcio }}.</p>

            <p class="font-medium">
                Places: {{ $ocupacio }}/{{ $classe->places }}
            </p>

            {{-- Sala + Monitor --}}
            <div class="flex flex-col gap-2">

                <div class="flex items-center gap-2">
                    <p>Sala:</p>
                    @if ($classe->sala)
                        <a href="{{ route('sales.show', $classe->sala) }}"
                           class="px-3 py-1 rounded border border-zinc-300 hover:bg-zinc-200 transition">
                            Sala {{ $classe->sala_id }}
                        </a>
                    @else
                        <span class="text-zinc-500">Sin sala!</span>
                    @endif
                </div>

                <div class="flex items-center gap-2">
                    <p>Monitor:</p>
                    @if ($classe->monitor)
                        @if ($user->rol === 'ADMIN')
                            <a href="{{ route('usuaris.show', $classe->monitor) }}"
                               class="px-3 py-1 rounded border border-zinc-300 hover:bg-zinc-200 transition">
                                {{ $classe->monitor->nom }} {{ $classe->monitor->cognom }}
                            </a>
                        @else
                            <p>{{ $classe->monitor->nom }} {{ $classe->monitor->cognom }}</p>
                        @endif
                    @else
                        <span class="text-zinc-500">Sin monitor!</span>
                    @endif
                </div>

            </div>

            {{-- Reserva CLIENT --}}
            @if (Auth::user()->rol === 'CLIENT')

                @php
                    $tieneReserva = $classe->reserves
                        ->where('client_id', Auth::id())
                        ->count() > 0;
                @endphp

                <div class="mt-2">

                    @if ($tieneReserva)
                        <button class="px-3 py-1 border border-zinc-300 bg-zinc-200 text-zinc-400 rounded cursor-not-allowed" disabled>
                            Reservado
                        </button>

                    @elseif(!$tieneReserva && $ocupacio < $classe->places)
                        <form action="{{ route('classes.quickReserve', ['classe' => $classe->id]) }}" method="POST">
                            @csrf
                            <button type="submit"
                                class="px-3 py-1 border border-zinc-300 bg-white rounded hover:bg-green-500 hover:text-white transition">
                                Reservar
                            </button>
                        </form>

                    @else
                        <p class="text-red-500 px-3 py-1 border border-red-500 rounded w-fit">
                            Està ple!
                        </p>
                    @endif

                </div>

            @endif

        </div>

        {{-- 🔹 DERECHA: RESERVAS (solo ADMIN y MONITOR) --}}
        @if (Auth::user()->rol !== 'CLIENT')

            <div class="w-full lg:w-4/5">

                <h2 class="text-3xl mt-9 mb-3">Reserves</h2>

                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-3">

                    @forelse ($reserves as $r)
                        @if ($r->classe->id === $classe->id)

                            <a href="{{ route('reserves.show', $r) }}"
                            onclick="event.stopPropagation()"
                            class="block px-3 py-2 border border-zinc-300 rounded hover:bg-zinc-100 transition">

                                <p class="text-sm text-zinc-600">
                                    {{ $r->client->nom }} {{ $r->client->cognom }}
                                    {{ $r->created_at->format('d/m/Y H:i') }}
                                </p>

                            </a>

                        @endif
                    @empty
                        <p class="text-zinc-500 col-span-3">No hi ha reserves!</p>
                    @endforelse

                </div>

            </div>

        @endif

    </div>

    {{-- Acciones --}}
        @if ($user->rol == 'ADMIN')
            <div class="mt-5 flex flex-row gap-2">

                <a href="{{ route('classes.edit', $classe->id) }}"
                class="rounded hover:bg-blue-500 hover:text-white transition border border-blue-500 px-5 py-1.5">
                    Editar
                </a>

                <form action="{{ route('classes.destroy', $classe->id) }}" method="POST">
                    @csrf
                    @method('DELETE')

                    <button type="submit"
                        onclick="return confirm('¿Estás seguro de que quieres eliminar esta clase?')"
                        class="cursor-pointer rounded hover:bg-red-500 hover:text-white transition border border-red-500 px-5 py-1.5">
                        Eliminar
                    </button>
                </form>

            </div>
        @endif

</x-app-layout>
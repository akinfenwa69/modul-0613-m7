<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Clases') }}
        </h2>
    </x-slot>

    @php
        $user = Auth::user();
    @endphp

    <div class="relative flex flex-col gap-3">

        <div class="flex flex-wrap gap-3 mb-4">

            {{-- Filtrar por tipo --}}
            <select name="tipus" form="filterForm" class="border rounded px-2 py-1 cursor-pointer">
                <option value="all" {{ $tipus_selected === 'all' ? 'selected' : '' }}>Todos los tipos</option>
                <option value="Yoga" {{ $tipus_selected === 'Yoga' ? 'selected' : '' }}>Yoga</option>
                <option value="Pilates" {{ $tipus_selected === 'Pilates' ? 'selected' : '' }}>Pilates</option>
                <option value="Spinning" {{ $tipus_selected === 'Spinning' ? 'selected' : '' }}>Spinning</option>
                <option value="Zumba" {{ $tipus_selected === 'Zumba' ? 'selected' : '' }}>Zumba</option>
                <option value="Crossfit" {{ $tipus_selected === 'Crossfit' ? 'selected' : '' }}>Crossfit</option>
                <option value="Boxeo" {{ $tipus_selected === 'Boxeo' ? 'selected' : '' }}>Boxeo</option>
                <option value="Aerobics" {{ $tipus_selected === 'Aerobics' ? 'selected' : '' }}>Aerobics</option>
                <option value="HIIT" {{ $tipus_selected === 'HIIT' ? 'selected' : '' }}>HIIT</option>
                <option value="Estiramientos" {{ $tipus_selected === 'Estiramientos' ? 'selected' : '' }}>Estiramientos</option>
                <option value="Natación" {{ $tipus_selected === 'Natación' ? 'selected' : '' }}>Natación</option>
                <option value="Stretching" {{ $tipus_selected === 'Stretching' ? 'selected' : '' }}>Stretching</option>
                <option value="Meditación" {{ $tipus_selected === 'Meditación' ? 'selected' : '' }}>Meditación</option>
                <option value="BodyPump" {{ $tipus_selected === 'BodyPump' ? 'selected' : '' }}>BodyPump</option>
                <option value="Ciclismo Indoor" {{ $tipus_selected === 'Ciclismo Indoor' ? 'selected' : '' }}>Ciclismo Indoor</option>
            </select>

            {{-- Filtrar por sala --}}
            <select name="sala" form="filterForm" class="border rounded px-2 py-1 cursor-pointer">
                <option value="all" {{ $sala_selected === 'all' ? 'selected' : '' }}>Todas las salas</option>
                @foreach ($sales as $s)
                    <option value="{{ $s->id }}" {{ $sala_selected == $s->id ? 'selected' : '' }}>
                        Sala {{ $s->id }}
                    </option>
                @endforeach
            </select>

            @if ($user->rol !== 'MONITOR')
                {{-- Filtrar por monitor --}}
                <select name="monitor" form="filterForm" class="border rounded px-2 py-1 cursor-pointer">
                    <option value="all" {{ $monitor_selected === 'all' ? 'selected' : '' }}>Todos los monitores</option>
                    @foreach ($monitors as $m)
                        <option value="{{ $m->id }}" {{ $monitor_selected == $m->id ? 'selected' : '' }}>
                            {{ $m->nom }} {{ $m->cognom }}
                        </option>
                    @endforeach
                </select>
            @endif

            <button type="submit" form="filterForm"
                class="bg-blue-500 cursor-pointer text-white px-3 py-1 rounded hover:bg-blue-600 transition">
                Filtrar
            </button>

        </div>

        {{-- Formulario oculto que envía los filtros por GET --}}
        <form id="filterForm" method="GET" action="{{ route('classes.index') }}"></form>


        <div class="flex items-center justify-between">
            {{-- Botó per crear classes (Només ADMIN) --}}
            @if ($user->rol == 'ADMIN')
                <a href="{{ route('classes.create') }}"
                    class="w-fit rounded text-lg transition! hover:scale-105! bg-blue-300 hover:bg-blue-400 px-12 py-1.5">
                    + Agregar
                </a>
            @else
                <div></div>
            @endif
            @php
                $filtered = $classes;

                echo "<span class='py-1 px-3 rounded border border-zinc-300! text-zinc-400'>" .
                    count($filtered) .
                    ' clases</span>';
            @endphp
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2! lg:grid-cols-3! xl:grid-cols-4! gap-5">
            @if (count($classes) > 0)
                @foreach ($filtered as $c)
                    @php
                        $ocupacio = 0;
                        $ocupacio = $c->reserves->count();
                    @endphp

                    <div class="relative bg-[#eee] rounded-xl overflow-hidden border border-zinc-300 transition hover:scale-105 cursor-pointer" onclick="window.location='{{ route('classes.show', $c) }}'">

                        <div class="relative">
                            <span class="absolute z-10 left-2 top-2 bg-zinc-200/80 rounded-full w-8 h-8 text-sm flex items-center justify-center">
                                {{ $c->id }}
                            </span>

                            <img src="{{ '/images/sala_' . Str::lower(Str::replace(' ', '_', $c->tipus)) . '.jpeg' }}"
                                alt="{{ $c->tipus }}"
                                class="h-24 w-full object-cover">

                            <span class="absolute z-10 right-2 bottom-2 bg-zinc-200/80 rounded-md px-3 py-1 text-sm">
                                @if ($ocupacio >= $c->places)
                                    FULL
                                @else
                                    {{ $ocupacio }}/{{ $c->places }}
                                @endif
                            </span>

                            <span class="bg-black/40 inset-0 absolute"></span>
                        </div>

                        {{-- CONTENIDO --}}
                        <div class="px-5 py-3 flex flex-col gap-1">

                            <div class="flex justify-between">
                                <p class="text-xm font-bold">{{ $c->tipus }}</p>

                                <p class="text-xs text-zinc-500">
                                    @if ($c->monitor)
                                        {{ $c->monitor->nom }} {{ $c->monitor->cognom }}
                                    @else
                                        Sin monitor
                                    @endif
                                </p>
                            </div>

                            <p class="text-sm text-zinc-500">
                                {{ \Carbon\Carbon::parse($c->dia)->format('d/m/Y') }},
                                {{ \Carbon\Carbon::parse($c->horari_inici)->format('H:i') }}
                                - {{ \Carbon\Carbon::parse($c->horari_final)->format('H:i') }}
                            </p>

                            <p class="text-xs text-zinc-500">{{ $c->descripcio }}</p>

                            @if ($c->sala)
                                    <button type="button"
                                        onclick="event.stopPropagation(); openSalaModal({{ $c->sala->id }})"
                                        class="relative z-20 border border-zinc-300 hover:bg-zinc-200 transition px-3 py-1 rounded-lg cursor-pointer mt-2">
                                        Sala {{ $c->sala->id }}
                                    </button>
                            @else
                                <p>-</p>
                            @endif


                            <div class="relative z-20 grid {{ $user->rol === 'ADMIN' ? 'grid-cols-2' : 'grid-cols-1' }} mt-2 gap-2">

                                {{-- ADMIN --}}
                                @if ($user->rol === 'ADMIN')

                                    <a href="{{ route('classes.edit', $c) }}"
                                    onclick="event.stopPropagation()"
                                    class="text-center px-3 py-1 border border-zinc-400 bg-white rounded hover:bg-blue-500 hover:text-white">
                                        Editar
                                    </a>

                                    <form action="{{ route('classes.destroy', $c) }}" method="POST"
                                        onclick="event.stopPropagation()">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                            class="w-full px-3 py-1 border border-zinc-400 bg-white rounded hover:bg-red-500 hover:text-white"
                                            onclick="return confirm('¿Estás seguro de que quieres eliminar esta clase?')">
                                            Eliminar
                                        </button>
                                    </form>

                                @elseif ($user->rol === 'CLIENT')

                                    @php
                                        $tieneReserva = $c->reserves
                                            ->where('client_id', Auth::id())
                                            ->count() > 0;
                                    @endphp

                                    @if ($tieneReserva)
                                        <button class="w-full px-3 py-1 border border-zinc-300 rounded cursor-not-allowed" disabled>
                                            Reservado
                                        </button>

                                    @elseif(!$tieneReserva && $ocupacio < $c->places)
                                        <form action="{{ route('classes.quickReserve', $c->id) }}" method="POST"
                                            onclick="event.stopPropagation()" class="col-span-1 md:col-span-2 w-full">
                                            @csrf
                                            <button type="submit" class="w-full px-3 py-1 border border-zinc-400 bg-white rounded transition hover:bg-green-500 hover:text-white">
                                                Reservar
                                            </button>
                                        </form>

                                    @else
                                        <p class="text-red-500 px-3 py-1 border border-red-500 rounded text-center">
                                            Està ple!
                                        </p>
                                    @endif

                                @endif

                            </div>

                        </div>
                    </div>
                @endforeach
            @else
                <span>No tienes ninguna clase!</span>
            @endif
        </div>
    </div>
</x-app-layout>

<div id="modal-container"></div>

<script>
    function openSalaModal(salaId) {
        fetch(`/sala/modal/${salaId}`)
            .then(response => response.text())
            .then(html => {
                document.getElementById('modal-container').innerHTML = html;
            });
    }
</script>
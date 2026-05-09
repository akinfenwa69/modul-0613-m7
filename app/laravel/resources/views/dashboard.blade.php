<x-app-layout>

    <section class="flex flex-col gap-1 mb-10">
        <span class="uppercase tracking-wider text-xs text-zinc-500">
            {{ Auth::user()->rol }}
        </span>

        <h1 class="text-6xl">
            Buenos días,
            <span class="uppercase text-blue-500">
                {{ Auth::user()->nom }} {{ Auth::user()->cognom ?? '' }}
            </span>
        </h1>
    </section>

    @if (Auth::user()->rol === 'CLIENT')

        {{-- RESUMEN --}}
        <section class="grid grid-cols-1 md:grid-cols-3 gap-4">

            <div class="p-4 border rounded-lg">
                <h3 class="font-bold">Mis reservas</h3>
                <p class="text-3xl font-semibold">
                    {{ \App\Models\Reserva::where('client_id', Auth::id())->count() }}
                </p>
                <p class="text-sm text-zinc-500">Total de clases reservadas</p>
            </div>

        </section>

        {{-- ACCIONES --}}
        <section class="mt-8 flex gap-3">
            <a href="{{ route('classes.index') }}"
            class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                Ver clases
            </a>

            <a href="{{ route('reserves.index') }}"
            class="px-4 py-2 bg-purple-500 text-white rounded hover:bg-purple-600">
                Mis reservas
            </a>

            <a href="{{ route('subscripcions.index') }}"
            class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">
                Mi suscripción
            </a>
        </section>

    @endif

    @if (Auth::user()->rol === 'MONITOR')

        <section class="grid grid-cols-1 md:grid-cols-3 gap-4">

            <div class="p-4 border rounded-lg">
                <h3 class="font-bold">Mis clases</h3>
                <p class="text-3xl font-semibold">
                    {{ \App\Models\Classe::where('monitor_id', Auth::id())->count() }}
                </p>
            </div>

            <div class="p-4 border rounded-lg">
                <h3 class="font-bold">Reservas totales</h3>
                <p class="text-3xl font-semibold">
                    {{ \App\Models\Reserva::whereHas('classe', function ($q) {
                        $q->where('monitor_id', Auth::id());
                    })->count() }}
                </p>
            </div>

            <div class="p-4 border rounded-lg">
                <h3 class="font-bold">Hoy</h3>
                <p class="text-sm text-zinc-500">{{ now()->format('d/m/Y') }}</p>
                <p class="text-sm">Agenda activa</p>
            </div>

        </section>

        {{-- CLASES DEL MONITOR --}}
        <section class="mt-8">
            <h2 class="text-xl font-bold mb-3">Mis clases asignadas</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">

                @foreach (\App\Models\Classe::where('monitor_id', Auth::id())->limit(4)->get() as $c)
                    <div class="p-4 border rounded-lg">
                        <p class="font-bold">{{ $c->tipus }}</p>
                        <p class="text-sm text-zinc-500">
                            {{ $c->dia }} · {{ $c->horari_inici }} - {{ $c->horari_final }}
                        </p>
                    </div>
                @endforeach

            </div>
        </section>

        {{-- ACCIONES --}}
        <section class="mt-8 flex gap-3">
            <a href="{{ route('classes.index') }}"
            class="px-4 py-2 bg-purple-500 text-white rounded hover:bg-purple-600">
                Ver clases
            </a>
        </section>

    @endif

    @if (Auth::user()->rol === 'ADMIN')

        {{-- KPIs --}}
        <section class="grid grid-cols-1 md:grid-cols-4 gap-4">

            <div class="p-4 border rounded-lg">
                <h3 class="font-bold">Usuarios</h3>
                <p class="text-3xl">{{ \App\Models\User::count() }}</p>
            </div>

            <div class="p-4 border rounded-lg">
                <h3 class="font-bold">Clases</h3>
                <p class="text-3xl">{{ \App\Models\Classe::count() }}</p>
            </div>

            <div class="p-4 border rounded-lg">
                <h3 class="font-bold">Reservas</h3>
                <p class="text-3xl">{{ \App\Models\Reserva::count() }}</p>
            </div>

            <div class="p-4 border rounded-lg">
                <h3 class="font-bold">Monitores</h3>
                <p class="text-3xl">{{ \App\Models\User::where('rol', 'MONITOR')->count() }}</p>
            </div>

        </section>

        {{-- ACCIONES ADMIN --}}
        <section class="mt-8 flex flex-wrap gap-3">

            <a href="{{ route('classes.index') }}"
            class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">
                Clases
            </a>

            <a href="{{ route('usuaris.index') }}"
            class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                Usuarios
            </a>

            <a href="{{ route('sales.index') }}"
            class="px-4 py-2 bg-purple-500 text-white rounded hover:bg-purple-600">
                Salas
            </a>

        </section>

    @endif

</x-app-layout>

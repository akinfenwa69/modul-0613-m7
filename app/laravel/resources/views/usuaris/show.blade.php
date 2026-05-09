<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ver Usuario') }}
        </h2>
    </x-slot>

    <div class="grid grid-cols-2 gap-8 mx-auto max-w-7xl">

        {{-- Basic Info --}}
        <div class="flex flex-col gap-3">

            <a href="{{ url()->previous() }}">&larr; Tornar</a>

            <div class="leading-4 mb-5">
                <p class="text-zinc-500">{{ $usuari->nom }}</p>
                <h1 class="text-5xl font-bold">{{ $usuari->cognom }}</h1>
            </div>

            <div>
                <p class="text-sm text-zinc-500">Correu Electrònic</p>
                <span class="text-lg font-medium">{{ $usuari->email }}</span>
            </div>

            <div>
                <p class="text-sm text-zinc-500">Telèfon</p>
                <span class="text-lg font-medium">{{ $usuari->telefon }}</span>
            </div>

            <div>
                <p class="text-sm text-zinc-500">Rol</p>
                <span class="text-lg font-medium">{{ $usuari->rol }}</span>
            </div>

            <div class="flex gap-2 items-center mt-5">
                <a href="{{ route('usuaris.edit', $usuari) }}"
                    class="rounded hover:bg-blue-500 hover:text-white transition border border-blue-500 px-5 py-1.5">
                    Editar
                </a>

                <form action="{{ route('usuaris.destroy', $usuari) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        onclick="return confirm('¿Estás seguro de que quieres eliminar este usuario?')"   
                        class="cursor-pointer rounded hover:bg-red-500 hover:text-white transition border border-red-500 px-5 py-1.5">Eliminar</button>
                </form>
            </div>
            
        </div>

        {{-- Role Based --}}
        <div class="flex flex-col gap-3">
            @if ($usuari->rol === 'CLIENT')
                @if (count($reserves))
                    <div class="border border-zinc-400 bg-[#eee] rounded-xl p-5 flex flex-col gap-3">
                        <h2 class="text-2xl font-medium">Reserves</h2>
                        <div class="flex flex-col gap-2">
                            @foreach ($reserves as $r)
                                <a href="{{ route('reserves.show', $r) }}"
                                    class="border border-zinc-400 hover:bg-zinc-200 transition p-3 rounded-lg">Classe
                                    {{ $r->classe_id }} - {{ $r->data_de_reserva }}</a>
                            @endforeach
                        </div>
                    </div>
                @endif
                @if (count($targetes))
                    <div class="border border-zinc-400 bg-[#eee] rounded-xl p-5 flex flex-col gap-3">
                        <h2 class="text-2xl font-medium">Targetes</h2>
                        <div class="flex flex-col gap-2">
                            @foreach ($targetes as $t)
                                <a href="{{ route('targetas.show', $t) }}"
                                    class="border border-zinc-400 hover:bg-zinc-200 transition p-3 rounded-lg">{{ $t->nom_titular }}</a>
                            @endforeach
                        </div>
                    </div>
                @endif
                @if (count($subscripcions))
                    <div class="border border-zinc-400 bg-[#eee] rounded-xl p-5 flex flex-col gap-3">
                        <h2 class="text-2xl font-medium">Subscripcions</h2>
                        <div class="flex flex-col gap-2">
                            @foreach ($subscripcions as $s)
                                <a href="{{ route('subscripcions.show', $s) }}"
                                    class="border border-zinc-400 hover:bg-zinc-200 transition p-3 rounded-lg">{{ $s->tipus }}</a>
                            @endforeach
                        </div>
                    </div>
                @endif
                @if (count($valoracions))
                    <div class="border border-zinc-400 bg-[#eee] rounded-xl p-5 flex flex-col gap-3">
                        <h2 class="text-2xl font-medium">Valoracions</h2>
                        <div class="flex flex-col gap-2">
                            @foreach ($valoracions as $v)
                                <a href="{{ route('valoracions.show', $v) }}"
                                    class="border truncate border-zinc-400 hover:bg-zinc-200 transition p-3 rounded-lg">{{ $v->estrelles }}<span
                                        class="text-zinc-500 text-sm">/5</span> - {{ $v->descripcio }}</a>
                            @endforeach
                        </div>
                    </div>
                @endif
            @elseif ($usuari->rol === 'MONITOR')
                @if (count($classes))
                    <div class="border border-zinc-400 bg-[#eee] rounded-xl p-5 flex flex-col gap-3">
                        <h2 class="text-2xl font-medium">Classes</h2>
                        <div class="flex flex-col gap-2">
                            @foreach ($classes as $c)
                                <a href="{{ route('classes.show', $c) }}"
                                    class="border truncate border-zinc-400 hover:bg-zinc-200 transition p-3 rounded-lg">{{ $c->tipus }}</a>
                            @endforeach
                        </div>
                    </div>
                @endif
            @endif
        </div>
    </div>
</x-app-layout>

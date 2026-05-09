<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ver Sala') }}
        </h2>
    </x-slot>

    <div class="flex flex-col lg:flex-row gap-8">

        {{-- IZQUIERDA: INFO SALA --}}
        <div class="w-full lg:w-1/3 flex flex-col gap-3">

            <a href="{{ url()->previous() }}">&larr; Volver</a>

            <div class="flex items-center gap-2">
                <span class="text-sm bg-zinc-200 rounded-full w-6 h-6 flex items-center justify-center">
                    {{ $sala->id }}
                </span>
                <p class="text-3xl">Sala de {{ $sala->tipus }}</p>
            </div>

            <img src="{{ '/images/sala_' . Str::lower(Str::replace(' ', '_', $sala->tipus)) . '.jpeg' }}"
                 alt="{{ $sala->tipus }}"
                 class="h-48 w-full rounded-lg object-cover bg-zinc-200 border border-zinc-300">

            <p class="text-zinc-600">{{ $sala->descripcio }}.</p>

        </div>

        {{-- DERECHA: CLASES --}}
        <div class="w-full lg:w-2/3 mt-8">

            <p class="text-3xl mb-4">Clases</p>

            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">

                @forelse ($classes as $classe)
                    <a href="{{ route('classes.show', $classe) }}"
                       class="block bg-white border border-zinc-300 rounded-xl p-4 hover:bg-zinc-100 hover:scale-[1.02] transition">

                        <div class="flex justify-between items-center mb-2">
                            <p class="text-lg font-semibold">{{ $classe->tipus }}</p>

                            <span class="text-xs bg-zinc-200 px-2 py-1 rounded-full">
                                {{ $classe->id }}
                            </span>
                        </div>

                        <p class="text-sm text-zinc-600">
                            🕒 {{ \Carbon\Carbon::parse($classe->horari_inici)->format('H:i') }}
                            - {{ \Carbon\Carbon::parse($classe->horari_final)->format('H:i') }}
                        </p>

                        <p class="text-sm text-zinc-600">
                            📅 {{ \Carbon\Carbon::parse($classe->dia)->format('d/m/Y') }}
                        </p>

                        <p class="text-sm text-zinc-600 mt-1">
                            👤 {{ $classe->monitor->nom ?? 'Sin asignar' }}
                            {{ $classe->monitor->cognom ?? '' }}
                        </p>

                    </a>
                @empty
                    <p class="text-center text-zinc-500 col-span-3">
                        No hay clases!
                    </p>
                @endforelse

            </div>

        </div>

    </div>

    {{-- Acciones --}}
        @if ($user->rol == 'ADMIN')
            <div class="mt-5 flex flex-row gap-2">

                <a href="{{ route('sales.edit', $sala->id) }}"
                class="rounded hover:bg-blue-500 hover:text-white transition border border-blue-500 px-5 py-1.5">
                    Editar
                </a>

                <form action="{{ route('sales.destroy', $sala->id) }}" method="POST">
                    @csrf
                    @method('DELETE')

                    <button type="submit"
                        onclick="return confirm('¿Estás seguro de que quieres eliminar esta sala?')"
                        class="cursor-pointer rounded hover:bg-red-500 hover:text-white transition border border-red-500 px-5 py-1.5">
                        Eliminar
                    </button>

                </form>

            </div>
        @endif

</x-app-layout>
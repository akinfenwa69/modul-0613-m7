<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Salas') }}
        </h2>
    </x-slot>

    @php
        $user = Auth::user();
    @endphp

    <div class="flex flex-col gap-3">
        {{-- Botó per crear salas (Només ADMIN) --}}
        @if ($user->rol === 'ADMIN')
            <a href="{{ route('sales.create') }}"
                class="w-fit rounded text-lg transition! hover:scale-105! bg-blue-300 hover:bg-blue-400 px-12 py-1.5">
                + Agregar
            </a>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2! lg:grid-cols-3! xl:grid-cols-4! gap-5">
            @if (count($sales) > 0)
                @foreach ($sales as $s)
                    <div class="relative bg-[#eee] rounded-xl overflow-hidden border border-zinc-300! transition! hover:scale-105! h-fit">

                        {{-- Parte clickeable para ver la tarjeta --}}
                        <a href="{{ route('sales.show', $s) }}" class="block">

                            <div class="relative">
                                <span
                                    class="absolute z-10 left-2 top-2 bg-zinc-100/80 rounded-full w-8 h-8 text-sm flex items-center justify-center">{{ $s->id }}</span>

                                <img src="{{ '/images/sala_' . Str::lower(Str::replace(' ', '_', $s->tipus)) . '.jpeg' }}"
                                    alt="{{ $s->tipus }}"
                                    class="h-24! flex items-center justify-center text-zinc-500 w-full bg-zinc-200 border-b! border-zinc-300! object-cover">
                                <span class="bg-black/40 inset-0 absolute"></span>
                            </div>

                            <div class="px-5 py-3 flex flex-col gap-1">
                                <p class="text-xl font-bold">{{ $s->tipus }}</p>
                                <p class="text-xs text-zinc-500">{{ $s->descripcio }}</p>

                                {{-- Només es mostra Acciones si es ADMIN --}}
                                @if ($user->rol === 'ADMIN')
                                    
                                    <div class="relative z-20 flex w-full gap-2 mt-2">

                                        <a href="{{ route('sales.edit', $s) }}"
                                            class="flex-1 text-center px-3 py-1 border border-zinc-400 text-black bg-white rounded transition-colors duration-200 hover:bg-blue-500 hover:text-white">
                                            Editar
                                        </a>

                                        <form action="{{ route('sales.destroy', $s) }}" method="POST" class="flex-1 flex">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                class="w-full px-3 py-1 border border-zinc-400 text-black bg-white rounded transition-colors duration-200 hover:bg-red-500 hover:text-white"
                                                onclick="return confirm('¿Estás seguro de que quieres eliminar esta sala?')">
                                                Eliminar
                                            </button>
                                        </form>

                                    </div>
                                @endif

                            </div>

                        </a>
                        
                    </div>
                @endforeach
            @else
                <span>No hay ninguna sala!</span>
            @endif
        </div>
    </div>

</x-app-layout>
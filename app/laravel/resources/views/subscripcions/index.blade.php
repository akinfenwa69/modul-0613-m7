<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Suscripciones') }}
        </h2>
    </x-slot>

    @php
        $user = Auth::user();
    @endphp

    <div class="flex flex-col gap-3">
        @if ($user->rol === 'ADMIN' || count($targetas))
            <a href="{{ route('subscripcions.create') }}"
                class="text-lg transition! hover:scale-105! bg-blue-300 hover:bg-blue-400 px-12 py-1.5 w-fit rounded">
                + Agregar
            </a>
        @else
            <a href="{{ route('targetas.create') }}"
                class="bg-red-700/60 hover:bg-red-700/80 transition! hover:scale-105! border-2! font-semibold border-red-500! rounded py-1.5 px-5 text-white w-fit ronuded">
                + Crea una tarjeta primero!
            </a>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2! lg:grid-cols-3! xl:grid-cols-4! gap-5">
            @if (count($subscripcions) > 0)
                @foreach ($subscripcions as $s)
                    <div class="relative overflow-hidden bg-[#eee] flex flex-col gap-3 border border-zinc-300! rounded-xl px-5 py-3 transition! hover:scale-105!">
                        
                        {{-- Parte clickeable para ver la tarjeta --}}
                        <a href="{{ route('subscripcions.show', $s) }}" class="block">
                        
                            <p class="text-lg font-bold">{{ $s->tipus }}</p>
                            <div class="flex gap-2">
                                <p class="text-4xl font-bold">{{ $s->preu }}€</p>
                                <p class="text-sm text-zinc-500 self-end">al mes</p>
                            </div>
                            <hr class="border-zinc-300! mt-2">
                            <p class="mt-2">
                                {{ \Carbon\Carbon::parse($s->data_inici)->format('d/m/Y') }} &mdash;
                                {{ \Carbon\Carbon::parse($s->data_fi)->format('d/m/Y') }}
                            </p>
                            @if ($user->rol !== 'CLIENT')
                                <a href="{{ route('users.show', $s->client->id) }}">
                                    <div
                                        class="relative z-20 border border-zinc-300! rounded hover:bg-zinc-200 transition px-3 py-1 cursor-pointer">
                                        {{ $s->client->nom }} {{ $s->client->cognom }}
                                    </div>
                                </a>
                            @endif
                            {{-- Només es mostra Acciones si es ADMIN --}}
                            @if ($user->rol === 'ADMIN')
                                <div class="relative z-20 grid grid-cols-2 gap-2">
                                    <a href="{{ route('subscripcions.edit', $s) }}" onclick="event.stopPropagation();"
                                        class="text-center px-3 py-1 border border-zinc-400! text-black bg-white rounded transition-colors duration-200 hover:bg-blue-500 hover:text-white">
                                        Editar
                                    </a>

                                    <form action="{{ route('subscripcions.destroy', $s) }}" method="POST" onclick="event.stopPropagation();" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="w-full cursor-pointer px-3 py-1 border border-zinc-400! text-black bg-white rounded transition-colors duration-200 hover:bg-red-500 hover:text-white"
                                            onclick="return confirm('¿Estás seguro de que quieres eliminar esta subscripción?')">
                                            Eliminar
                                        </button>
                                    </form>
                                </div>
                            @endif

                        </a>

                    </div>
                @endforeach
                </table>
            @else
                <span>No tienes ninguna subscripcion!</span>
            @endif
        </div>
    </div>
</x-app-layout>

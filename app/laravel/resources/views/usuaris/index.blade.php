<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Usuarios') }}
        </h2>
    </x-slot>

    @php
        $user = Auth::user();
    @endphp

    <div class="relative flex flex-col gap-3">

        <a href="{{ route('usuaris.create') }}"
            class="text-lg transition! hover:scale-105! bg-blue-300 hover:bg-blue-400 px-12 py-1.5 w-fit rounded">
            + Agregar
        </a>

        <div>
            @if (count($usuaris) > 0)
                <div class="gap-5 grid! grid-cols-1! md:grid-cols-2! lg:grid-cols-3! xl:grid-cols-4!">
                    @foreach ($usuaris as $u)
                        <div class="group bg-[#eee] relative overflow-hidden border border-zinc-300! rounded-lg px-5 py-4 flex flex-col gap-2 transition! hover:scale-105!" onclick="window.location='{{ route('usuaris.show', $u) }}'">
                        
                            <div class="flex justify-between items-start">
                                    <div class="flex gap-2 items-center">
                                        <span
                                            class="p-2! bg-linear-to-br from-purple-500 to-blue-400 rounded-full h-9 w-9 flex items-center justify-center text-white font-bold text-xl uppercase">{{ mb_substr($u->nom, 0, 1) }}</span>
                                        <div class="leading-3!">
                                            <p class="text-xs text-zinc-500">{{ $u->rol }}</p>
                                            <p>{{ $u->nom }} {{ $u->cognom }}</p>
                                        </div>
                                    </div>
                                    <div
                                        class="flex items-center absolute z-20 top-3 right-3 opacity-0 group-hover:opacity-100 transition">
                                        <a href="{{ route('usuaris.edit', $u) }}"
                                            class="flex p-1! items-center justify-center hover:bg-blue-600/70! hover:text-white! transition rounded-full h-7 w-7">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="lucide lucide-pencil-icon lucide-pencil">
                                                <path
                                                    d="M21.174 6.812a1 1 0 0 0-3.986-3.987L3.842 16.174a2 2 0 0 0-.5.83l-1.321 4.352a.5.5 0 0 0 .623.622l4.353-1.32a2 2 0 0 0 .83-.497z" />
                                                <path d="m15 5 4 4" />
                                            </svg>
                                        </a>
                                        <form action="{{ route('usuaris.destroy', $u) }}" method="POST" onclick="event.stopPropagation()">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                onclick="return confirm('¿Estás seguro de que quieres eliminar este usuario?')"
                                                class="flex cursor-pointer p-1! items-center justify-center hover:bg-red-600/70! hover:text-white! transition rounded-full h-7 w-7">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="lucide lucide-trash2-icon lucide-trash-2">
                                                    <path d="M10 11v6" />
                                                    <path d="M14 11v6" />
                                                    <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6" />
                                                    <path d="M3 6h18" />
                                                    <path d="M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                            </div>

                            <div class="flex justify-between items-center">
                                    <div class="flex items-center gap-1 text-xs text-zinc-600">
                                        <p>{{ $u->email }}</p>
                                        <span class="text-zinc-400">&vert;</span>
                                        <p>{{ $u->telefon }}</p>
                                    </div>
                            </div>

                        </div>
                    @endforeach
                </div>
            @else
                <span>No hay usuarios!</span>
            @endif
        </div>
        
    </div>
</x-app-layout>

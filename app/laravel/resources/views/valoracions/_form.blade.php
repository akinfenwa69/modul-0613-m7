@php
    $user = Auth::user();
@endphp

<div class="flex flex-col gap-5 max-w-2xl mx-auto">

    <form action="{{ isset($valoracio) ? route('valoracions.update', $valoracio) : route('valoracions.store') }}"
        method="POST"
        class="flex flex-col gap-5 max-w-2xl mx-auto">

        @csrf
        @if(isset($valoracio))
            @method('PUT')
        @endif

        {{-- DESCRIPCIÓN --}}
        <div class="flex flex-col gap-3">
            <label>Descripción</label>

            <textarea name="descripcio"
                class="border border-zinc-300 hover:border-zinc-500 transition focus:outline-1 focus:border-black py-1.5 px-3 rounded-md"
                placeholder="Describe...">{{ old('descripcio', $valoracio->descripcio ?? '') }}</textarea>

            @error('descripcio')
                <div class="text-red-500 text-sm">{{ $message }}</div>
            @enderror
        </div>

        {{-- ESTRELLAS --}}
        <div class="flex flex-col gap-3">
            <label>Estrellas</label>

            <input type="number" name="estrelles" min="0" max="5"
                class="border border-zinc-300 hover:border-zinc-500 transition focus:outline-1 focus:border-black py-1.5 px-3 rounded-md"
                value="{{ old('estrelles', $valoracio->estrelles ?? 0) }}">

            @error('estrelles')
                <div class="text-red-500 text-sm">{{ $message }}</div>
            @enderror
        </div>

        {{-- CLASE --}}
        <div class="flex flex-col gap-3">
            <label>Clase</label>

            <select name="classe_id"
                class="border border-zinc-300 hover:border-zinc-500 transition focus:outline-1 focus:border-black py-1.5 px-3 rounded-md">

                @foreach ($classes as $classe)
                    <option value="{{ $classe->id }}"
                        {{ old('classe_id', $valoracio->classe_id ?? '') == $classe->id ? 'selected' : '' }}>

                        {{ $classe->tipus }} —
                        {{ $classe->dia }} —
                        {{ $classe->horari_inici }} - {{ $classe->horari_final }}

                    </option>
                @endforeach

            </select>

            @error('classe_id')
                <div class="text-red-500 text-sm">{{ $message }}</div>
            @enderror
        </div>

        {{-- CLIENT --}}
        <div class="flex flex-col gap-3">

            @if ($user->rol === 'CLIENT')

                {{-- CLIENT AUTOMÁTICO --}}
                <input type="hidden" name="client_id" value="{{ $user->id }}">

                <p class="text-sm text-zinc-500">
                    Valorando como: <strong>{{ $user->nom }} {{ $user->cognom }}</strong>
                </p>

            @else

                {{-- ADMIN / MONITOR --}}
                <label>Cliente</label>

                <select name="client_id"
                    class="border border-zinc-300 hover:border-zinc-500 transition focus:outline-1 focus:border-black cursor-pointer py-2 px-3 rounded-md">

                    @foreach ($usuaris_registrats as $usuari)
                        <option value="{{ $usuari->id }}"
                            {{ old('client_id', $valoracio->client_id ?? '') == $usuari->id ? 'selected' : '' }}>
                            {{ $usuari->nom }} {{ $usuari->cognom }}
                        </option>
                    @endforeach

                </select>

            @endif

            @error('client_id')
                <div class="text-red-500 text-sm">{{ $message }}</div>
            @enderror
        </div>

        {{-- BOTONES --}}
        <div class="flex items-center gap-3 self-end">
            <a href="{{ route('valoracions.index') }}">&larr; Volver</a>

            <button type="submit"
                class="border border-zinc-300 hover:border-zinc-400 hover:bg-zinc-300 transition rounded py-1.5 px-5 cursor-pointer">
                Guardar
            </button>
        </div>

    </form>

</div>

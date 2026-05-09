@php
    $user = Auth::user();
@endphp

<div class="flex flex-col gap-5 max-w-2xl mx-auto">

    <div class="flex flex-col gap-3">
        <label>Clase</label>
        <select name="classe_id"
            class="border border-zinc-300! hover:border-zinc-500! transition focus:outline-1 cursor-pointer py-2 px-3 rounded-md!">
            @foreach ($classes as $classe)
                <option value="{{ $classe->id }}"
                    {{ old('classe_id', $reserva->classe_id ?? '') == $classe->id ? 'selected' : '' }}>
                    {{ $classe->tipus }}, {{ $classe->dia }}, {{ $classe->horari_inici }} -
                    {{ $classe->horari_final }},
                    {{ $classe->descripcio }}.
                </option>
            @endforeach
        </select>
    </div>

    <div class="flex flex-col gap-3">
        @if ($user->rol === 'CLIENT')

        @else
            <label>Cliente</label>
            <select name="client_id"
                class="border border-zinc-300! hover:border-zinc-500! transition focus:outline-1 cursor-pointer py-2 px-3 rounded-md!">
                @foreach ($usuaris_registrats as $usuari)
                    <option value="{{ $usuari->id }}"
                        {{ old('client_id', $reserva->client_id ?? '') == $usuari->id ? 'selected' : '' }}>
                        {{ $usuari->nom }} {{ $usuari->cognom }}
                    </option>
                @endforeach
            </select>
        @endif
    </div>

    <div class="flex items-center gap-3 self-end mt-3">
        <a href="{{ route('reserves.index') }}">&larr; Volver</a>
        <button type="submit"
            class="border border-zinc-300! hover:border-zinc-400! hover:bg-zinc-300! transition rounded py-1.5 px-5 cursor-pointer">Guardar</button>
    </div>

</div>

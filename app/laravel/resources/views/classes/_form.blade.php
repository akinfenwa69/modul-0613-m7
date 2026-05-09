<div class="flex flex-col gap-5 mx-auto max-w-2xl">

    <div class="flex flex-col gap-3">
        <label>Tipo de clase</label>
        <select name="tipus"
            class="border border-zinc-300! hover:border-zinc-500! transition focus:outline-1 focus:border-black! py-2 px-3 rounded-md! cursor-pointer">
            @php $tipus = old('tipus', $classe->tipus ?? ''); @endphp
            <option value="Yoga" {{ $tipus === 'Yoga' ? 'selected' : '' }}>Yoga</option>
            <option value="Pilates" {{ $tipus === 'Pilates' ? 'selected' : '' }}>Pilates</option>
            <option value="Spinning" {{ $tipus === 'Spinning' ? 'selected' : '' }}>Spinning</option>
            <option value="Zumba" {{ $tipus === 'Zumba' ? 'selected' : '' }}>Zumba</option>
            <option value="Crossfit" {{ $tipus === 'Crossfit' ? 'selected' : '' }}>Crossfit</option>
            <option value="Boxeo" {{ $tipus === 'Boxeo' ? 'selected' : '' }}>Boxeo</option>
            <option value="Aerobics" {{ $tipus === 'Aerobics' ? 'selected' : '' }}>Aerobics</option>
            <option value="HIIT" {{ $tipus === 'HIIT' ? 'selected' : '' }}>HIIT</option>
            <option value="Estiramientos" {{ $tipus === 'Estiramientos' ? 'selected' : '' }}>Estiramientos</option>
            <option value="Natación" {{ $tipus === 'Natación' ? 'selected' : '' }}>Natación</option>
            <option value="Stretching" {{ $tipus === 'Stretching' ? 'selected' : '' }}>Stretching</option>
            <option value="Meditación" {{ $tipus === 'Meditación' ? 'selected' : '' }}>Meditación</option>
            <option value="BodyPump" {{ $tipus === 'BodyPump' ? 'selected' : '' }}>BodyPump</option>
            <option value="Ciclismo Indoor" {{ $tipus === 'Ciclismo Indoor' ? 'selected' : '' }}>Ciclismo Indoor
            </option>
        </select>
        @error('tipus')
            <div>{{ $message }}</div>
        @enderror
    </div>

    <div class="flex flex-col gap-3">
        <label>Descripción</label>
        <textarea name="descripcio" placeholder="Describe..." class="border border-zinc-300! hover:border-zinc-500! transition focus:outline-1 focus:border-black! py-1.5 px-3 rounded-md!">{{ old('descripcio', $classe->descripcio ?? '') }}</textarea>
        @error('descripcio')
            <div>{{ $message }}</div>
        @enderror
    </div>


    <div class="grid grid-cols-2 lg:grid-cols-3 gap-3 gap-y-5">
        <div class="flex flex-col gap-3 col-span-2 lg:col-span-1">
            <label>Dia</label>
            <input type="date" name="dia"
                class="border border-zinc-300! hover:border-zinc-500! transition focus:outline-1 focus:border-black! rounded-md!"
                value="{{ old('dia', $classe->dia ?? '') }}">
            @error('dia')
                <div>{{ $message }}</div>
            @enderror
        </div>

        <div class="flex flex-col gap-3">
            <label>Horario de inicio</label>
            <input type="time" name="horari_inici"
                class="border border-zinc-300! hover:border-zinc-500! transition focus:outline-1 focus:border-black! rounded-md!"
                value="{{ old('horari_inici', isset($classe) ? \Carbon\Carbon::parse($classe->horari_inici)->format('H:i') : '') }}">
            @error('horari_inici')
                <div>{{ $message }}</div>
            @enderror
        </div>

        <div class="flex flex-col gap-3">
            <label>Horario de finalización</label>
            <input type="time" name="horari_final"
                class="border border-zinc-300! hover:border-zinc-500! transition focus:outline-1 focus:border-black! rounded-md!"
                value="{{ old('horari_final', isset($classe) ? \Carbon\Carbon::parse($classe->horari_final)->format('H:i') : '') }}">
            @error('horari_final')
                <div>{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="flex flex-col gap-3">
        <label>Plazas</label>
        <input type="number" name="places" min="1" max="50"
            class="border border-zinc-300! hover:border-zinc-500! transition focus:outline-1 focus:border-black! py-1.5 px-3 rounded-md!"
            value="{{ old('places', $classe->places ?? 0) }}">
        @error('places')
            <div>{{ $message }}</div>
        @enderror
    </div>

    <div class="grid grid-cols-2 gap-3">
        <div class="flex flex-col gap-3">
            <label>Sala</label>
            <select name="sala_id"
                class="border border-zinc-300! hover:border-zinc-500! transition focus:outline-1 focus:border-black! py-2 px-3 rounded-md! cursor-pointer">
                <option value="" {{ old('sala_id', $classe->sala_id ?? 'selected') }}>
                    Selecciona una sala
                </option>
                @foreach ($sales as $sala)
                    <option value="{{ $sala->id }}"
                        {{ old('sala_id', $classe->sala_id ?? '') == $sala->id ? 'selected' : '' }}>
                        Sala {{ $sala->id }}, {{ $sala->tipus }}, {{ $sala->descripcio }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="flex flex-col gap-3">
            <label>Monitor</label>
            <select name="monitor_id"
                class="border border-zinc-300! hover:border-zinc-500! transition focus:outline-1 focus:border-black! py-2 px-3 rounded-md! cursor-pointer">
                @foreach ($usuaris_registrats as $usuari)
                    <option value="{{ $usuari->id }}"
                        {{ old('monitor_id', $reserva->monitor_id ?? '') == $usuari->id ? 'selected' : '' }}>
                        {{ $usuari->nom }} {{ $usuari->cognom }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="mt-3 flex gap-3 items-center self-end">
        <a href="{{ route('classes.index') }}">&larr; Volver</a>
        <button type="submit"
            class="border border-zinc-300! hover:border-zinc-400! hover:bg-zinc-300! transition rounded py-1.5 px-5 cursor-pointer">Guardar</button>
    </div>

</div>

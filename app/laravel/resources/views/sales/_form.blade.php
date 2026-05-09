@csrf
<div class="flex flex-col gap-5 mx-auto max-w-2xl">

    <div class="flex flex-col gap-3">
        <label for="tipus">Tipo de sala</label>
        <select name="tipus" id="tipus"
            class="border border-zinc-300! hover:border-zinc-500! transition focus:outline-1 cursor-pointer py-2 px-3 rounded-md!">
            <option value="Fuerza" {{ old('tipus', $sala->tipus ?? '') == 'Fuerza' ? 'selected' : '' }}>Fuerza</option>
            <option value="Cardio" {{ old('tipus', $sala->tipus ?? '') == 'Cardio' ? 'selected' : '' }}>Cardio</option>
            <option value="Yoga" {{ old('tipus', $sala->tipus ?? '') == 'Yoga' ? 'selected' : '' }}>Yoga</option>
            <option value="Pilates" {{ old('tipus', $sala->tipus ?? '') == 'Pilates' ? 'selected' : '' }}>Pilates
            </option>
            <option value="CrossFit" {{ old('tipus', $sala->tipus ?? '') == 'CrossFit' ? 'selected' : '' }}>CrossFit
            </option>
            <option value="Spinning" {{ old('tipus', $sala->tipus ?? '') == 'Spinning' ? 'selected' : '' }}>Spinning
            </option>
            <option value="Zumba" {{ old('tipus', $sala->tipus ?? '') == 'Zumba' ? 'selected' : '' }}>Zumba</option>
            <option value="HIIT" {{ old('tipus', $sala->tipus ?? '') == 'HIIT' ? 'selected' : '' }}>HIIT</option>
            <option value="Boxeo" {{ old('tipus', $sala->tipus ?? '') == 'Boxeo' ? 'selected' : '' }}>Boxeo</option>
            <option value="Estiramientos" {{ old('tipus', $sala->tipus ?? '') == 'Estiramientos' ? 'selected' : '' }}>
                Estiramientos</option>
            <option value="Natación" {{ old('tipus', $sala->tipus ?? '') == 'Natación' ? 'selected' : '' }}>Natación
            </option>
            <option value="Stretching" {{ old('tipus', $sala->tipus ?? '') == 'Stretching' ? 'selected' : '' }}>
                Stretching
            </option>
            <option value="Meditación" {{ old('tipus', $sala->tipus ?? '') == 'Meditación' ? 'selected' : '' }}>
                Meditación
            </option>
            <option value="BodyPump" {{ old('tipus', $sala->tipus ?? '') == 'BodyPump' ? 'selected' : '' }}>BodyPump
            </option>
            <option value="Ciclismo Indoor"
                {{ old('tipus', $sala->tipus ?? '') == 'Ciclismo Indoor' ? 'selected' : '' }}>
                Ciclismo Indoor</option>
        </select>
        @error('tipus')
            <div>{{ $message }}</div>
        @enderror
    </div>

    <div class="flex flex-col gap-3">
        <label for="descripcio">Descripción</label>
        <textarea name="descripcio" placeholder="Describe..." class="border border-zinc-300! hover:border-zinc-500! transition focus:outline-1 focus:border-black! py-1.5 px-3 rounded-md!">{{ old('descripcio', $sala->descripcio ?? '') }}</textarea>
        @error('descripcio')
            <div>{{ $message }}</div>
        @enderror
    </div>

    <div class="flex items-center gap-3 mt-3 self-end">
        <a href="{{ route('sales.index') }}">&larr; Volver</a>
        <button type="submit" class="border border-zinc-300! hover:border-zinc-400! hover:bg-zinc-300! transition rounded py-1.5 px-5 cursor-pointer">Guardar</button>
    </div>

</div>

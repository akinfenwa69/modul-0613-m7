@csrf
@php
    $rol = old('rol', $usuari->rol ?? 'CLIENT');
@endphp

<div class="flex flex-col gap-5 max-w-2xl mx-auto">

    <div class="grid grid-cols-1 sm:grid-cols-2 gap-y-5 gap-3">
        <div class="flex flex-col gap-3">
            <label for="nom">Nombre</label>
            <input type="text" name="nom" id="nom" placeholder="Nombre..."
                value="{{ old('nom', $usuari->nom ?? '') }}"
                class="border border-zinc-300! hover:border-zinc-500! transition focus:outline-1 focus:border-black! py-1.5 px-3 rounded-md!">
            @error('nom')
                <div>{{ $message }}</div>
            @enderror
        </div>

        <div class="flex flex-col gap-3">
            <label for="cognom">Apellido</label>
            <input type="text" name="cognom" id="cognom" placeholder="Apellido..."
                value="{{ old('cognom', $usuari->cognom ?? '') }}"
                class="border border-zinc-300! hover:border-zinc-500! transition focus:outline-1 focus:border-black! py-1.5 px-3 rounded-md!">
            @error('cognom')
                <div>{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="flex flex-col gap-3">
        <label for="email">Correo electrónico</label>
        <input type="email" name="email" id="email" placeholder="example@email.com"
            value="{{ old('email', $usuari->email ?? '') }}"
            class="border border-zinc-300! hover:border-zinc-500! transition focus:outline-1 focus:border-black! py-1.5 px-3 rounded-md!">
        @error('email')
            <div>{{ $message }}</div>
        @enderror
    </div>

    <div class="flex flex-col gap-3">
        <label for="password">Contraseña</label>
        <input type="text" name="password" id="password" placeholder="a-z, A-Z, 0-9"
            value="{{ old('password', $usuari->password ?? '') }}"
            class="border border-zinc-300! hover:border-zinc-500! transition focus:outline-1 focus:border-black! py-1.5 px-3 rounded-md!">
        @error('password')
            <div>{{ $message }}</div>
        @enderror
    </div>

    <div class="flex flex-col gap-3">
        <label for="telefon">Teléfono</label>
        <input type="tel" name="telefon" id="telefon" placeholder="123456789"
            value="{{ old('telefon', $usuari->telefon ?? '') }}"
            class="border border-zinc-300! hover:border-zinc-500! transition focus:outline-1 focus:border-black! py-1.5 px-3 rounded-md!">
        @error('telefon')
            <div>{{ $message }}</div>
        @enderror
    </div>

    <div class="flex flex-col gap-3">
        <label for="rol">Rol</label>
        <select name="rol" id="rol"
            class="border border-zinc-300! hover:border-zinc-500! transition focus:outline-1 focus:border-black! cursor-pointer py-2 px-3 rounded-md!">
            <option value="CLIENT" {{ $rol === 'CLIENT' ? 'selected' : '' }}>Client</option>
            <option value="MONITOR" {{ $rol === 'MONITOR' ? 'selected' : '' }}>Monitor</option>
            <option value="ADMIN" {{ $rol === 'ADMIN' ? 'selected' : '' }}>Admin</option>
        </select>
        @error('rol')
            <div>{{ $message }}</div>
        @enderror
    </div>

    <div class="flex items-center mt-3 self-end gap-3">
        <a href="{{ route('usuaris.index') }}">&larr; Volver</a>
        <button type="submit"
            class="border border-zinc-300! hover:border-zinc-400! hover:bg-zinc-300! transition rounded py-1.5 px-5 cursor-pointer">Guardar</button>
    </div>
</div>

@php
    $user = Auth::user();
@endphp

<form action="{{ route('targetas.store') }}" method="POST">
    @csrf

    <div class="flex flex-col gap-5 max-w-2xl mx-auto">

        <div class="flex flex-col gap-3">
            <label>Nombre del titular</label>
            <input type="text" name="nom_titular" placeholder="Nombre..."
                value="{{ old('nom_titular') }}"
                class="border py-1.5 px-3 rounded-md">
            @error('nom_titular')
                <div>{{ $message }}</div>
            @enderror
        </div>

        <div class="flex items-center gap-3">
            <div class="flex flex-col gap-3 flex-1">
                <label>Número de cuenta</label>
                <input type="tel" name="numero_compte" placeholder="13-19 dígitos"
                    value="{{ old('numero_compte') }}"
                    class="border py-1.5 px-3 rounded-md">
                @error('numero_compte')
                    <div>{{ $message }}</div>
                @enderror
            </div>

            <div class="flex flex-col gap-3">
                <label>Activa</label>

                <!-- IMPORTANTE -->
                <input type="hidden" name="activa" value="0">
                <input type="checkbox" name="activa" value="1"
                    {{ old('activa') ? 'checked' : '' }}>

                @error('activa')
                    <div>{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 gap-y-5">
            <div class="flex flex-col gap-3">
                <label>Fecha de caducidad</label>
                <input type="date" name="data_validesa"
                    value="{{ old('data_validesa') }}"
                    class="border py-1.5 px-3 rounded-md">
                @error('data_validesa')
                    <div>{{ $message }}</div>
                @enderror
            </div>

            <div class="flex flex-col gap-3">
                <label>CVV</label>
                <input type="text" name="cvv" placeholder="3-4 dígitos"
                    value="{{ old('cvv') }}"
                    class="border py-1.5 px-3 rounded-md">
                @error('cvv')
                    <div>{{ $message }}</div>
                @enderror
            </div>

            <div class="flex flex-col gap-3">
                <label>Tipo de tarjeta</label>
                <select name="tipus_targeta" class="border py-2 px-3 rounded-md">
                    <option value="VISA" {{ old('tipus_targeta') == 'VISA' ? 'selected' : '' }}>VISA</option>
                    <option value="MASTERCARD" {{ old('tipus_targeta') == 'MASTERCARD' ? 'selected' : '' }}>MASTERCARD</option>
                    <option value="AMEX" {{ old('tipus_targeta') == 'AMEX' ? 'selected' : '' }}>AMEX</option>
                </select>
                @error('tipus_targeta')
                    <div>{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="flex flex-col gap-3">
            @if ($user->rol === 'CLIENT')

                <!-- cliente normal: se asigna solo -->
                <input type="hidden" name="client_id" value="{{ $user->id }}">

            @else
                <!-- admin -->
                <label>Cliente</label>
                <select name="client_id" class="border py-2 px-3 rounded-md">
                    @foreach ($usuaris_registrats as $usuari)
                        <option value="{{ $usuari->id }}">
                            {{ $usuari->nom }} {{ $usuari->cognom }}
                        </option>
                    @endforeach
                </select>
            @endif

            @error('client_id')
                <div>{{ $message }}</div>
            @enderror
        </div>

        <div class="flex items-center gap-3 self-end mt-3">
            <a href="{{ route('targetas.index') }}">&larr; Volver</a>
            <button type="submit" class="border rounded py-1.5 px-5">
                Guardar
            </button>
        </div>

    </div>
</form>
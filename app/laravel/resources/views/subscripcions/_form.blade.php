@php
    $user = Auth::user();

    $targetasDisponibles =
        $user->rol === 'ADMIN'
            ? App\Models\TargetaUsuari::all()
            : App\Models\TargetaUsuari::where('client_id', $user->id)->get();
@endphp

<form action="{{ route('subscripcions.store') }}" method="POST">
    @csrf

    <div class="flex flex-col gap-5 max-w-2xl mx-auto">

        {{-- TIPO --}}
        <div class="flex items-center gap-3">
            <div class="flex flex-col gap-3 flex-1">
                <label>Tipo de suscripción</label>

                <select name="tipus" id="tipus"
                    class="border px-3 py-2 rounded-md">

                    <option value="Bàsica"
                        {{ old('tipus', $tipusSeleccionat ?? '') == 'Bàsica' ? 'selected' : '' }}>
                        Bàsica
                    </option>

                    <option value="Premium"
                        {{ old('tipus', $tipusSeleccionat ?? '') == 'Premium' ? 'selected' : '' }}>
                        Premium
                    </option>

                    <option value="VIP"
                        {{ old('tipus', $tipusSeleccionat ?? '') == 'VIP' ? 'selected' : '' }}>
                        VIP
                    </option>

                </select>

                @error('tipus')
                    <div>{{ $message }}</div>
                @enderror
            </div>

            <div class="flex flex-col gap-3 min-w-32">
                <label>Precio:</label>
                <span id="precio_span" class="border rounded px-3 py-1.5">-</span>
            </div>
        </div>

        {{-- FECHAS --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">

            @if ($user->rol === 'ADMIN')

                <div class="flex flex-col gap-3">
                    <label>Fecha inicio</label>
                    <input type="date" name="data_inici"
                        class="border px-3 py-2 rounded-md"
                        value="{{ old('data_inici', now()->format('Y-m-d')) }}">
                </div>

                <div class="flex flex-col gap-3">
                    <label>Fecha fin</label>
                    <input type="date" name="data_fi"
                        class="border px-3 py-2 rounded-md"
                        value="{{ old('data_fi', now()->addMonth()->format('Y-m-d')) }}">
                </div>

            @else
                <input type="hidden" name="data_inici" value="{{ now()->format('Y-m-d') }}">
                <input type="hidden" name="data_fi" value="{{ now()->addMonth()->format('Y-m-d') }}">
            @endif

        </div>

        {{-- CLIENTE --}}
        <div class="flex flex-col gap-3">

            @if ($user->rol === 'CLIENT')
                <input type="hidden" name="client_id" value="{{ $user->id }}">
            @else
                <label>Cliente</label>
                <select name="client_id" id="client_select"
                    class="border px-3 py-2 rounded-md">
                    <option value="">Selecciona un cliente</option>
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

        {{-- TARJETA --}}
        <div class="flex flex-col gap-3">

            <label>Tarjeta</label>

            <select name="targeta_id" id="targeta_select"
                class="border px-3 py-2 rounded-md"
                required>
                @foreach ($targetasDisponibles as $targeta)
                    <option value="{{ $targeta->id }}"
                        data-client="{{ $targeta->client_id }}">
                        {{ $targeta->nom_titular }} | {{ $targeta->tipus_targeta }}
                    </option>
                @endforeach
            </select>

            <span id="no_tarjetas_msg" class="text-red-500 hidden">
                Este cliente no tiene tarjetas
            </span>

            @error('targeta_id')
                <div>{{ $message }}</div>
            @enderror
        </div>

        {{-- BOTONES --}}
        <div class="flex justify-end gap-3 mt-3">
            <a href="{{ route('subscripcions.index') }}">Volver</a>
            <button type="submit" class="border px-5 py-2 rounded">
                Guardar
            </button>
        </div>

    </div>
</form>

<script>
const precios = {
    'Bàsica': 20,
    'Premium': 30,
    'VIP': 50
};

const tipo = document.getElementById('tipus');
const precioSpan = document.getElementById('precio_span');

function actualizarPrecio() {
    precioSpan.textContent = (precios[tipo.value] || 0) + '€';
}

tipo.addEventListener('change', actualizarPrecio);
window.addEventListener('DOMContentLoaded', actualizarPrecio);

// CLIENT FILTER SAFE
const clientSelect = document.getElementById('client_select');
const targetaSelect = document.getElementById('targeta_select');
const aviso = document.getElementById('no_tarjetas_msg');

if (clientSelect && targetaSelect) {

    const allOptions = Array.from(targetaSelect.options);

    function filtrar() {
        const id = clientSelect.value;

        targetaSelect.innerHTML = '';

        if (!id) {
            targetaSelect.innerHTML = '<option value="">Selecciona cliente</option>';
            return;
        }

        const filtradas = allOptions.filter(o => o.dataset.client === id);

        if (filtradas.length === 0) {
            aviso.classList.remove('hidden');
            targetaSelect.innerHTML = '<option value="">Sin tarjetas</option>';
            return;
        }

        aviso.classList.add('hidden');
        filtradas.forEach(o => targetaSelect.appendChild(o));
    }

    clientSelect.addEventListener('change', filtrar);
    window.addEventListener('DOMContentLoaded', filtrar);
}
</script>

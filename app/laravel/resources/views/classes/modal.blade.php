<div class="fixed inset-0 bg-black/50 flex items-center justify-center z-[9999]">
    <div class="bg-white rounded-2xl shadow-lg p-6 max-w-lg w-full relative">
        {{-- Botón de cerrar --}}
        <button onclick="document.getElementById('modal-container').innerHTML=''"
            class="absolute cursor-pointer top-1 right-2 text-gray-500 hover:text-black text-2xl font-bold hover:text-red-600 transition-colors">&times;</button>
        {{-- Imagen de la sala --}}
        @if ($classe->sala)
            <img src="{{ '/images/sala_' . Str::lower(Str::replace(' ', '_', $classe->sala->tipus)) . '.jpeg' }}"
                alt="Sala {{ $classe->sala->id }}" class="w-120 h-60 object-cover rounded-2xl mb-4">
        @endif

        {{-- Datos de la clase --}}
        <h2 class="text-xl font-bold mb-2">Clase de {{ $classe->tipus }}</h2>
        <p class="mb-1"><strong>Descripción:</strong> {{ $classe->descripcio }}</p>
        <p class="mb-1"><strong>Sala:</strong> {{ $classe->sala->id ?? '-' }}</p>
        <p class="mb-1"><strong>Día:</strong> {{ \Carbon\Carbon::parse($classe->dia)->format('d/m/Y') }}</p>
        <p class="mb-1"><strong>Hora:</strong> {{ \Carbon\Carbon::parse($classe->horari_inici)->format('H:i') }} -
            {{ \Carbon\Carbon::parse($classe->horari_final)->format('H:i') }}</p>
        <p class="mb-1"><strong>Monitor:</strong> {{ $classe->monitor->nom ?? 'Sin asignar' }}
            {{ $classe->monitor->cognom ?? '' }}</p>
        <p class="mb-1"><strong>Plazas:</strong> {{ $classe->places }} (ocupadas: {{ $classe->reserves->count() }})
        </p>
    </div>
</div>

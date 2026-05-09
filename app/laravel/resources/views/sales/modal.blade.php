<div class="fixed inset-0 bg-black/50 flex items-center justify-center z-[9999]">
    <div class="bg-white rounded-2xl shadow-lg p-6 max-w-lg w-full relative">
        {{-- Botón de cerrar --}}
        <button onclick="document.getElementById('modal-container').innerHTML=''"
            class="absolute cursor-pointer top-1 right-2 text-gray-500 hover:text-black text-2xl font-bold hover:text-red-600 transition-colors">&times;</button>

        {{-- Imagen de la sala --}}
        <img src="{{ '/images/sala_' . Str::lower(Str::replace(' ', '_', $sala->tipus)) . '.jpeg' }}"
            alt="{{ $sala->tipus }}" class="w-120 h-60 object-cover rounded-2xl mb-4">

        {{-- Datos de la sala --}}
        <h2 class="text-2xl font-bold mb-2">Sala de {{ $sala->tipus }}</h2>
        <p class="mb-2"><strong>Descripción:</strong> {{ $sala->descripcio }}</p>
        <p class="mb-2"><strong>Número de sala:</strong> {{ $sala->id }}</p>
        <p class="mb-2"><strong>Clases disponibles:</strong> {{ $sala->classes->count() }}</p>

        @if ($sala->classes->count() > 0)
            <div class="mt-2 text-sm">
                {{-- Cabecera tipo tabla --}}
                <div class="flex bg-gray-200 rounded-t px-3 py-1 font-semibold">
                    <div class="w-1/4">Classe</div>
                    <div class="w-1/4">Hora</div>
                    <div class="w-1/4">Día</div>
                    <div class="w-1/4">Monitor</div>
                </div>

                {{-- Filas con información --}}
                @foreach ($sala->classes as $classe)
                    <div class="flex justify-between items-center bg-gray-100/60 px-3 py-1 border-b last:border-b-0">
                        <div class="w-1/4">{{ $classe->tipus }}</div>
                        <div class="w-1/4">
                            {{ \Carbon\Carbon::parse($classe->horari_inici)->format('H:i') }} -
                            {{ \Carbon\Carbon::parse($classe->horari_final)->format('H:i') }}
                        </div>
                        <div class="w-1/4">
                            {{ \Carbon\Carbon::parse($classe->dia)->format('d/m/Y') }}
                        </div>
                        <div class="w-1/4">
                            {{ $classe->monitor->nom ?? 'Sin asignar' }}
                            {{ $classe->monitor->cognom ?? '' }}
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>

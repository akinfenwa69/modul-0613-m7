<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Reserva') }}
        </h2>
    </x-slot>

    <div class="p-10">
        <form action="{{ route('reserves.update', $reserva->id) }}" method="post">
            @csrf
            @method('put')
            @include('reserves._form', ['reserva' => $reserva])
        </form>
    </div>
</x-app-layout>

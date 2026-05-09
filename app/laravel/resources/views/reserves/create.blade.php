<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Agregar Reserva') }}
        </h2>
    </x-slot>

    <div class="p-10">
        <form method="POST" action="{{ route('reserves.store') }}">
            @csrf
            @include('reserves._form')
        </form>
    </div>
</x-app-layout>

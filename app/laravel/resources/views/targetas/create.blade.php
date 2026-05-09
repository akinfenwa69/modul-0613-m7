<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Agregar Tarjeta') }}
        </h2>
    </x-slot>
    <div class="p-10">
        <form method="POST" action="{{ route('targetas.store') }}">
            @csrf
            @include('targetas._form')
        </form>
    </div>
</x-app-layout>

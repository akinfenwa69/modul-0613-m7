<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Agregar Sala') }}
        </h2>
    </x-slot>

    <div class="p-10">
        <form method="POST" action="{{ route('sales.store') }}">
            @include('sales._form')
        </form>
    </div>
</x-app-layout>

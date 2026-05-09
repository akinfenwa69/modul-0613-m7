<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Sala') }}
        </h2>
    </x-slot>

    <div class="p-10">
        <form action="{{ route('sales.update', $sala->id) }}" method="post">
            @csrf
            @method('put')
            @include('sales._form', ['sala' => $sala])
        </form>
    </div>
</x-app-layout>

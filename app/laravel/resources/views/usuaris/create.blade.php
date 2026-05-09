<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Agregar Usuario') }}
        </h2>
    </x-slot>

    <div class="p-10">
        <form action="{{ route('usuaris.store') }}" method="post">
            @include('usuaris._form')
        </form>
    </div>
</x-app-layout>

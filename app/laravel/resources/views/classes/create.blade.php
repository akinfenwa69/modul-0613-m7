<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Agregar Clase') }}
        </h2>
    </x-slot>

    <div class="p-10">
        <form method="POST" action="{{ route('classes.store') }}">
            @csrf
            @include('classes._form')
        </form>
    </div>

</x-app-layout>

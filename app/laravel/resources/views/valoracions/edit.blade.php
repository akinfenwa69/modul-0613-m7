<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Valoración') }}
        </h2>
    </x-slot>

    <div class="p10">
        <form method="POST" action="{{ route('valoracions.update', $valoracio) }}">
            @csrf
            @method('PUT')
            @include('valoracions._form', ['valoracio' => $valoracio])
        </form>
    </div>
</x-app-layout>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Usuario') }}
        </h2>
    </x-slot>

    <div class="p-10">
        <form action="{{ route('usuaris.update', $usuari) }}" method="post">
            @method('put')
            @include('usuaris._form', ['usuari' => $usuari])
        </form>
    </div>
</x-app-layout>

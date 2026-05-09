<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Clase') }}
        </h2>
    </x-slot>

    <div class="p-10">
        <form action="{{ route('classes.update', $classe->id) }}" method="post">
            @csrf
            @method('put')
            @include('classes._form', ['classe' => $classe])
        </form>
    </div>
</x-app-layout>

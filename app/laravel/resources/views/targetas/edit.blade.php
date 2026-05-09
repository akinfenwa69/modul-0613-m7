<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Tarjeta') }}
        </h2>
    </x-slot>

    <div class="p-10">
        <form action="{{ route('targetas.update', $targeta->id) }}" method="post">
            @csrf
            @method('put')
            @include('targetas._form', ['targeta' => $targeta])
        </form>
    </div>
</x-app-layout>

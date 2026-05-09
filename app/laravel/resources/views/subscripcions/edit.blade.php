<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Suscripción') }}
        </h2>
    </x-slot>
    <div class="p-10">
        <form action="{{ route('subscripcions.update', $subscripcio->id) }}" method="post">
            @csrf
            @method('put')
            @include('subscripcions._form', ['subscripcio' => $subscripcio])
        </form>
    </div>
</x-app-layout>

<x-app-layout>
    <x-slot name="header">
        <h1 class="text-2xl font-semibold text-gray-900">Добавить пиццу</h1>
    </x-slot>

    <div class="mx-auto max-w-4xl px-4 py-8 sm:px-6 lg:px-8">
        <form method="POST" action="{{ route('pizzas.store') }}" class="rounded-lg border border-gray-200 bg-white p-6 shadow-sm">
            @include('pizzas._form', ['buttonText' => 'Сохранить'])
        </form>
    </div>
</x-app-layout>

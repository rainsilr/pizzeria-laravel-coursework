<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <p class="text-sm font-semibold text-orange-600">{{ $pizza->category->name }}</p>
                <h1 class="text-2xl font-semibold text-gray-900">{{ $pizza->name }}</h1>
            </div>
            @auth
                <div class="flex gap-2">
                    <a href="{{ route('pizzas.edit', $pizza) }}" class="rounded-md border border-gray-300 px-4 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-50">
                        Редактировать
                    </a>
                    <form method="POST" action="{{ route('pizzas.destroy', $pizza) }}" onsubmit="return confirm('Удалить эту пиццу из меню?')">
                        @csrf
                        @method('DELETE')
                        <button class="rounded-md bg-red-600 px-4 py-2 text-sm font-semibold text-white hover:bg-red-700">Удалить</button>
                    </form>
                </div>
            @endauth
        </div>
    </x-slot>

    <div class="mx-auto max-w-4xl px-4 py-8 sm:px-6 lg:px-8">
        @if (session('status'))
            <div class="mb-6 rounded-md border border-green-200 bg-green-50 px-4 py-3 text-sm font-medium text-green-800">
                {{ session('status') }}
            </div>
        @endif

        <article class="rounded-lg border border-gray-200 bg-white p-6 shadow-sm">
            <div class="grid gap-6 md:grid-cols-[1fr_220px]">
                <div>
                    <h2 class="text-lg font-semibold text-gray-900">Описание</h2>
                    <p class="mt-3 leading-7 text-gray-700">{{ $pizza->description }}</p>
                </div>
                <dl class="rounded-lg bg-orange-50 p-4">
                    <div class="flex justify-between gap-4 py-2">
                        <dt class="text-gray-600">Цена</dt>
                        <dd class="font-semibold text-gray-900">{{ number_format($pizza->price, 0, ',', ' ') }} руб.</dd>
                    </div>
                    <div class="flex justify-between gap-4 border-t border-orange-100 py-2">
                        <dt class="text-gray-600">Размер</dt>
                        <dd class="font-semibold text-gray-900">{{ $pizza->size_cm }} см</dd>
                    </div>
                    <div class="flex justify-between gap-4 border-t border-orange-100 py-2">
                        <dt class="text-gray-600">Острота</dt>
                        <dd class="font-semibold text-gray-900">{{ $pizza->is_spicy ? 'Острая' : 'Не острая' }}</dd>
                    </div>
                    <div class="flex justify-between gap-4 border-t border-orange-100 py-2">
                        <dt class="text-gray-600">Наличие</dt>
                        <dd class="font-semibold text-gray-900">{{ $pizza->is_available ? 'В меню' : 'Скрыта' }}</dd>
                    </div>
                </dl>
            </div>
        </article>

        <div class="mt-6">
            <a href="{{ route('pizzas.index') }}" class="text-sm font-semibold text-orange-700 hover:text-orange-800">Вернуться к меню</a>
        </div>
    </div>
</x-app-layout>

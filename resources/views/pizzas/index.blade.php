<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-2xl font-semibold text-gray-900">Меню пиццерии</h1>
                <p class="text-sm text-gray-600">Публичный список пицц с категориями, поиском и пагинацией.</p>
            </div>
            @auth
                <a href="{{ route('pizzas.create') }}" class="rounded-md bg-orange-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-orange-700">
                    Добавить пиццу
                </a>
            @endauth
        </div>
    </x-slot>

    <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
        @if (session('status'))
            <div class="mb-6 rounded-md border border-green-200 bg-green-50 px-4 py-3 text-sm font-medium text-green-800">
                {{ session('status') }}
            </div>
        @endif

        <form method="GET" action="{{ route('pizzas.index') }}" class="grid gap-3 rounded-lg border border-gray-200 bg-white p-4 shadow-sm md:grid-cols-[1fr_260px_auto]">
            <input
                type="search"
                name="search"
                value="{{ $search }}"
                placeholder="Поиск по названию или описанию"
                class="rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500"
            >
            <select name="category_id" class="rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500">
                <option value="0">Все категории</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" @selected($categoryId === $category->id)>{{ $category->name }}</option>
                @endforeach
            </select>
            <button class="rounded-md bg-gray-900 px-5 py-2 text-sm font-semibold text-white hover:bg-gray-800">Найти</button>
        </form>

        <div class="mt-6 grid gap-5 md:grid-cols-2 xl:grid-cols-4">
            @forelse ($pizzas as $pizza)
                <article class="flex min-h-64 flex-col rounded-lg border border-gray-200 bg-white p-5 shadow-sm">
                    <div class="flex items-start justify-between gap-3">
                        <p class="text-sm font-medium text-orange-600">{{ $pizza->category->name }}</p>
                        @if ($pizza->is_spicy)
                            <span class="rounded-full bg-red-100 px-2 py-1 text-xs font-semibold text-red-700">Острая</span>
                        @endif
                    </div>
                    <h2 class="mt-3 text-xl font-semibold text-gray-950">{{ $pizza->name }}</h2>
                    <p class="mt-2 flex-1 text-sm leading-6 text-gray-600">{{ $pizza->description }}</p>
                    <div class="mt-4 flex items-center justify-between border-t border-gray-100 pt-4">
                        <div>
                            <p class="font-semibold text-gray-900">{{ number_format($pizza->price, 0, ',', ' ') }} руб.</p>
                            <p class="text-sm text-gray-500">{{ $pizza->size_cm }} см</p>
                        </div>
                        <a href="{{ route('pizzas.show', $pizza) }}" class="rounded-md border border-orange-200 px-3 py-2 text-sm font-semibold text-orange-700 hover:bg-orange-50">
                            Подробнее
                        </a>
                    </div>
                </article>
            @empty
                <div class="rounded-lg border border-gray-200 bg-white p-6 text-gray-600 md:col-span-2 xl:col-span-4">
                    По вашему запросу ничего не найдено.
                </div>
            @endforelse
        </div>

        <div class="mt-8">
            {{ $pizzas->links() }}
        </div>
    </div>
</x-app-layout>

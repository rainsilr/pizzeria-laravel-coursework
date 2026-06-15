<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-1">
            <h1 class="text-2xl font-semibold text-gray-900">Пиццерия Laravel</h1>
            <p class="text-sm text-gray-600">Учебное веб-приложение для управления меню пиццерии.</p>
        </div>
    </x-slot>

    <section class="bg-white">
        <div class="mx-auto grid max-w-7xl gap-8 px-4 py-10 sm:px-6 lg:grid-cols-[1.2fr_0.8fr] lg:px-8">
            <div class="flex flex-col justify-center">
                <p class="text-sm font-semibold uppercase tracking-wide text-orange-600">Свежее меню каждый день</p>
                <h2 class="mt-3 text-4xl font-bold text-gray-950">Пиццы, категории и удобное управление заказным меню</h2>
                <p class="mt-4 max-w-2xl text-lg text-gray-600">
                    Приложение демонстрирует CRUD-операции, связи моделей Laravel, публичный просмотр меню и защищенное управление записями после входа.
                </p>
                <div class="mt-6 flex flex-wrap gap-3">
                    <a href="{{ route('pizzas.index') }}" class="rounded-md bg-orange-600 px-5 py-3 text-sm font-semibold text-white shadow-sm hover:bg-orange-700">
                        Открыть меню
                    </a>
                    @guest
                        <a href="{{ route('login') }}" class="rounded-md border border-orange-200 px-5 py-3 text-sm font-semibold text-orange-700 hover:bg-orange-50">
                            Войти для управления
                        </a>
                    @endguest
                </div>
            </div>

            <div class="rounded-lg border border-orange-100 bg-orange-50 p-6">
                <h3 class="text-lg font-semibold text-gray-900">Категории меню</h3>
                <div class="mt-4 space-y-3">
                    @forelse ($categories as $category)
                        <div class="flex items-center justify-between rounded-md bg-white px-4 py-3 shadow-sm">
                            <div>
                                <p class="font-medium text-gray-900">{{ $category->name }}</p>
                                <p class="text-sm text-gray-500">{{ $category->description }}</p>
                            </div>
                            <span class="rounded-full bg-orange-100 px-3 py-1 text-sm font-semibold text-orange-700">
                                {{ $category->pizzas_count }}
                            </span>
                        </div>
                    @empty
                        <p class="text-sm text-gray-600">Категории появятся после заполнения базы данных.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </section>

    <section class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between">
            <h2 class="text-2xl font-semibold text-gray-900">Новинки меню</h2>
            <a href="{{ route('pizzas.index') }}" class="text-sm font-semibold text-orange-700 hover:text-orange-800">Все пиццы</a>
        </div>

        <div class="mt-6 grid gap-5 md:grid-cols-3">
            @forelse ($featuredPizzas as $pizza)
                <article class="rounded-lg border border-gray-200 bg-white p-5 shadow-sm">
                    <p class="text-sm font-medium text-orange-600">{{ $pizza->category->name }}</p>
                    <h3 class="mt-2 text-xl font-semibold text-gray-950">{{ $pizza->name }}</h3>
                    <p class="mt-2 text-sm text-gray-600">{{ $pizza->description }}</p>
                    <div class="mt-4 flex items-center justify-between">
                        <span class="font-semibold text-gray-900">{{ number_format($pizza->price, 0, ',', ' ') }} руб.</span>
                        <a href="{{ route('pizzas.show', $pizza) }}" class="text-sm font-semibold text-orange-700 hover:text-orange-800">Подробнее</a>
                    </div>
                </article>
            @empty
                <p class="text-gray-600">Заполните базу тестовыми данными, чтобы увидеть меню.</p>
            @endforelse
        </div>
    </section>
</x-app-layout>

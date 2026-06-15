<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Панель управления</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    Вы вошли в систему. Управление меню доступно на странице
                    <a href="{{ route('pizzas.index') }}" class="font-semibold text-orange-700 hover:text-orange-800">пиццерии</a>.
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

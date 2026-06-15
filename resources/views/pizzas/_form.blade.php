@csrf

<div class="grid gap-5 md:grid-cols-2">
    <div>
        <x-input-label for="name" value="Название пиццы" />
        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $pizza->name)" required maxlength="120" />
        <x-input-error :messages="$errors->get('name')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="category_id" value="Категория" />
        <select id="category_id" name="category_id" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500">
            <option value="">Выберите категорию</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" @selected((int) old('category_id', $pizza->category_id) === $category->id)>{{ $category->name }}</option>
            @endforeach
        </select>
        <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="price" value="Цена, руб." />
        <x-text-input id="price" name="price" type="number" min="100" max="9999" step="0.01" class="mt-1 block w-full" :value="old('price', $pizza->price)" required />
        <x-input-error :messages="$errors->get('price')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="size_cm" value="Размер, см" />
        <x-text-input id="size_cm" name="size_cm" type="number" min="20" max="50" class="mt-1 block w-full" :value="old('size_cm', $pizza->size_cm)" required />
        <x-input-error :messages="$errors->get('size_cm')" class="mt-2" />
    </div>

    <div class="md:col-span-2">
        <x-input-label for="description" value="Описание" />
        <textarea id="description" name="description" rows="5" required maxlength="1000" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500">{{ old('description', $pizza->description) }}</textarea>
        <x-input-error :messages="$errors->get('description')" class="mt-2" />
    </div>

    <label class="flex items-center gap-3 rounded-md border border-gray-200 bg-gray-50 px-4 py-3">
        <input type="checkbox" name="is_spicy" value="1" @checked(old('is_spicy', $pizza->is_spicy)) class="rounded border-gray-300 text-orange-600 shadow-sm focus:ring-orange-500">
        <span class="text-sm font-medium text-gray-700">Острая пицца</span>
    </label>

    <label class="flex items-center gap-3 rounded-md border border-gray-200 bg-gray-50 px-4 py-3">
        <input type="checkbox" name="is_available" value="1" @checked(old('is_available', $pizza->is_available)) class="rounded border-gray-300 text-orange-600 shadow-sm focus:ring-orange-500">
        <span class="text-sm font-medium text-gray-700">Показывать в меню</span>
    </label>
</div>

<div class="mt-6 flex items-center gap-3">
    <x-primary-button>{{ $buttonText }}</x-primary-button>
    <a href="{{ route('pizzas.index') }}" class="text-sm font-semibold text-gray-600 hover:text-gray-900">Отмена</a>
</div>

<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Pizza;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PizzaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->string('search')->trim()->toString();
        $categoryId = $request->integer('category_id');

        $pizzas = Pizza::query()
            ->with('category')
            ->when($search, function ($query) use ($search) {
                $query->where(function ($query) use ($search) {
                    $query->where('name', 'like', "%{$search}%")
                        ->orWhere('description', 'like', "%{$search}%");
                });
            })
            ->when($categoryId, fn ($query) => $query->where('category_id', $categoryId))
            ->latest()
            ->paginate(8)
            ->withQueryString();

        return view('pizzas.index', [
            'pizzas' => $pizzas,
            'categories' => Category::orderBy('name')->get(),
            'search' => $search,
            'categoryId' => $categoryId,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pizzas.create', [
            'pizza' => new Pizza([
                'is_available' => true,
                'size_cm' => 30,
            ]),
            'categories' => Category::orderBy('name')->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $pizza = Pizza::create($this->validatedData($request));

        return redirect()
            ->route('pizzas.show', $pizza)
            ->with('status', 'Пицца успешно добавлена в меню.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pizza $pizza)
    {
        return view('pizzas.show', [
            'pizza' => $pizza->load('category'),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pizza $pizza)
    {
        return view('pizzas.edit', [
            'pizza' => $pizza,
            'categories' => Category::orderBy('name')->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pizza $pizza)
    {
        $pizza->update($this->validatedData($request, $pizza));

        return redirect()
            ->route('pizzas.show', $pizza)
            ->with('status', 'Данные о пицце обновлены.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pizza $pizza)
    {
        $pizza->delete();

        return redirect()
            ->route('pizzas.index')
            ->with('status', 'Пицца удалена из меню.');
    }

    private function validatedData(Request $request, ?Pizza $pizza = null): array
    {
        $data = $request->validate([
            'category_id' => ['required', 'integer', 'exists:categories,id'],
            'name' => ['required', 'string', 'max:120', Rule::unique('pizzas')->ignore($pizza)],
            'description' => ['required', 'string', 'min:10', 'max:1000'],
            'price' => ['required', 'numeric', 'min:100', 'max:9999'],
            'size_cm' => ['required', 'integer', 'min:20', 'max:50'],
            'is_spicy' => ['nullable', 'boolean'],
            'is_available' => ['nullable', 'boolean'],
        ]);

        $data['is_spicy'] = $request->boolean('is_spicy');
        $data['is_available'] = $request->boolean('is_available');

        return $data;
    }
}

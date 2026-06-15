<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Pizza;
use Illuminate\Support\Facades\Schema;

class HomeController extends Controller
{
    public function __invoke()
    {
        if (! Schema::hasTable('categories') || ! Schema::hasTable('pizzas')) {
            return view('welcome', [
                'categories' => collect(),
                'featuredPizzas' => collect(),
            ]);
        }

        return view('welcome', [
            'categories' => Category::withCount('pizzas')->orderBy('name')->get(),
            'featuredPizzas' => Pizza::with('category')->where('is_available', true)->latest()->take(3)->get(),
        ]);
    }
}

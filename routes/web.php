<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PizzaController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');

Route::get('/pizzas', [PizzaController::class, 'index'])->name('pizzas.index');

Route::middleware('auth')->group(function () {
    Route::get('/pizzas/create', [PizzaController::class, 'create'])->name('pizzas.create');
    Route::post('/pizzas', [PizzaController::class, 'store'])->name('pizzas.store');
    Route::get('/pizzas/{pizza}/edit', [PizzaController::class, 'edit'])->name('pizzas.edit');
    Route::put('/pizzas/{pizza}', [PizzaController::class, 'update'])->name('pizzas.update');
    Route::delete('/pizzas/{pizza}', [PizzaController::class, 'destroy'])->name('pizzas.destroy');
});

Route::get('/pizzas/{pizza}', [PizzaController::class, 'show'])->name('pizzas.show');

Route::redirect('/dashboard', '/pizzas')->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

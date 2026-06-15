<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Pizza;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Pizza>
 */
class PizzaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'category_id' => Category::factory(),
            'name' => fake()->unique()->randomElement([
                'Маргарита',
                'Пепперони',
                'Четыре сыра',
                'Гавайская',
                'Барбекю',
                'Карбонара',
                'Диабло',
                'Ветчина и грибы',
                'Мясная',
                'Охотничья',
                'Цезарь',
                'Сырный цыпленок',
                'Вегетарианская',
                'Мексиканская',
                'Фирменная',
                'Морская',
                'Деревенская',
            ]),
            'description' => fake()->sentence(14),
            'price' => fake()->randomFloat(2, 399, 999),
            'size_cm' => fake()->randomElement([25, 30, 35, 40]),
            'is_spicy' => fake()->boolean(25),
            'is_available' => fake()->boolean(90),
        ];
    }
}

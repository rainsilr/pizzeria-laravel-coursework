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
            'name' => $this->faker->unique()->randomElement([
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
            'description' => $this->faker->sentence(14),
            'price' => $this->faker->randomFloat(2, 399, 999),
            'size_cm' => $this->faker->randomElement([25, 30, 35, 40]),
            'is_spicy' => $this->faker->boolean(25),
            'is_available' => $this->faker->boolean(90),
        ];
    }
}

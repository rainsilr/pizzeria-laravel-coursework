<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Pizza;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PizzaManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_public_menu_displays_pizzas_with_categories(): void
    {
        $category = Category::factory()->create(['name' => 'Классические пиццы']);
        Pizza::factory()->create([
            'category_id' => $category->id,
            'name' => 'Маргарита',
            'description' => 'Томатный соус, моцарелла и свежий базилик.',
        ]);

        $response = $this->get(route('pizzas.index'));

        $response->assertOk();
        $response->assertSee('Маргарита');
        $response->assertSee('Классические пиццы');
    }

    public function test_guest_is_redirected_from_create_form(): void
    {
        $response = $this->get(route('pizzas.create'));

        $response->assertRedirect(route('login'));
    }

    public function test_authenticated_user_can_create_pizza(): void
    {
        $user = User::factory()->create();
        $category = Category::factory()->create();

        $response = $this
            ->actingAs($user)
            ->post(route('pizzas.store'), [
                'category_id' => $category->id,
                'name' => 'Фирменная',
                'description' => 'Курица, ветчина, грибы, томаты и фирменный соус.',
                'price' => 729,
                'size_cm' => 35,
                'is_spicy' => false,
                'is_available' => true,
            ]);

        $pizza = Pizza::where('name', 'Фирменная')->firstOrFail();

        $response->assertRedirect(route('pizzas.show', $pizza));
        $this->assertDatabaseHas('pizzas', [
            'name' => 'Фирменная',
            'category_id' => $category->id,
        ]);
    }
}

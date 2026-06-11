<?php

namespace Tests\Feature;

use App\Models\Order;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OrderFormTest extends TestCase
{
    use RefreshDatabase;

    public function test_home_page_is_accessible(): void
    {
        $this->get(route('home'))
            ->assertOk()
            ->assertSee('Оставьте заявку');
    }

    public function test_valid_order_is_stored_and_redirects_with_success(): void
    {
        $payload = [
            'name'    => 'Иван Иванов',
            'email'   => 'ivan@example.com',
            'message' => 'Нужна консультация по обслуживанию.',
        ];

        $this->post(route('orders.store'), $payload)
            ->assertRedirect(route('home'))
            ->assertSessionHas('success');

        $this->assertDatabaseHas('orders', $payload);
    }

    public function test_order_validation_rejects_invalid_data(): void
    {
        $this->post(route('orders.store'), [
            'name'    => '',
            'email'   => 'not-an-email',
            'message' => 'коротко',
        ])
            ->assertSessionHasErrors(['name', 'email', 'message']);

        $this->assertDatabaseCount('orders', 0);
    }

    public function test_order_validation_preserves_input_on_error(): void
    {
        $this->from(route('home'))
            ->post(route('orders.store'), [
                'name'    => 'Пётр',
                'email'   => 'bad-email',
                'message' => 'Слишком коротко',
            ])
            ->assertRedirect(route('home'))
            ->assertSessionHasErrors('email')
            ->assertSessionHasInput('name', 'Пётр');
    }
}

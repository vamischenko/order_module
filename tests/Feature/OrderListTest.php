<?php

namespace Tests\Feature;

use App\Models\Order;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OrderListTest extends TestCase
{
    use RefreshDatabase;

    public function test_orders_are_displayed_for_authenticated_user(): void
    {
        $user = User::factory()->create();

        $order = Order::factory()->create([
            'name'    => 'Алексей Смирнов',
            'email'   => 'alexey@example.com',
            'message' => 'Тестовое сообщение для проверки списка.',
        ]);

        $this->actingAs($user)
            ->get(route('orders.list'))
            ->assertOk()
            ->assertSee('Алексей Смирнов')
            ->assertSee('alexey@example.com')
            ->assertSee($order->message);
    }

    public function test_orders_can_be_filtered_by_name_or_email(): void
    {
        $user = User::factory()->create();

        Order::factory()->create([
            'name'  => 'Мария Петрова',
            'email' => 'maria@example.com',
        ]);

        Order::factory()->create([
            'name'  => 'Другой клиент',
            'email' => 'other@example.com',
        ]);

        $this->actingAs($user)
            ->get(route('orders.list', ['search' => 'maria@example.com']))
            ->assertOk()
            ->assertSee('Мария Петрова')
            ->assertDontSee('Другой клиент');
    }

    public function test_empty_state_is_shown_when_no_orders_exist(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get(route('orders.list'))
            ->assertOk()
            ->assertSee('Заявок пока нет.');
    }
}

<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_is_redirected_from_orders_list_to_login(): void
    {
        $this->get(route('orders.list'))
            ->assertRedirect(route('login'));
    }

    public function test_authenticated_user_can_view_orders_list(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get(route('orders.list'))
            ->assertOk()
            ->assertSee('Список заявок');
    }

    public function test_user_can_login_with_valid_credentials(): void
    {
        $user = User::factory()->create([
            'email'    => 'admin@example.com',
            'password' => 'secret-password',
        ]);

        $this->post(route('login.submit'), [
            'email'    => 'admin@example.com',
            'password' => 'secret-password',
        ])
            ->assertRedirect(route('orders.list'));

        $this->assertAuthenticatedAs($user);
    }

    public function test_login_fails_with_invalid_credentials(): void
    {
        User::factory()->create([
            'email'    => 'admin@example.com',
            'password' => 'secret-password',
        ]);

        $this->from(route('login'))
            ->post(route('login.submit'), [
                'email'    => 'admin@example.com',
                'password' => 'wrong-password',
            ])
            ->assertRedirect(route('login'))
            ->assertSessionHasErrors('email');

        $this->assertGuest();
    }

    public function test_authenticated_user_can_logout(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->post(route('logout'))
            ->assertRedirect(route('home'));

        $this->assertGuest();
    }

    public function test_logged_in_user_is_redirected_from_login_page(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get(route('login'))
            ->assertRedirect(route('orders.list'));
    }
}

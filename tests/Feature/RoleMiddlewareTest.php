<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RoleMiddlewareTest extends TestCase
{
    use RefreshDatabase;

    public function test_client_can_access_client_route(): void
    {
        $user = User::factory()->create(['role' => 'user']);
        $token = $user->createToken('auth_token')->plainTextToken;

        $this->withHeader('Authorization', 'Bearer '.$token)
            ->getJson('/api/client/orders')
            ->assertOk()
            ->assertJson(['message' => 'Client orders']);
    }

    public function test_client_cannot_access_business_route(): void
    {
        $user = User::factory()->create(['role' => 'user']);
        $token = $user->createToken('auth_token')->plainTextToken;

        $this->withHeader('Authorization', 'Bearer '.$token)
            ->getJson('/api/business/dashboard')
            ->assertStatus(403);
    }

    public function test_business_can_access_business_route(): void
    {
        $user = User::factory()->create(['role' => 'business']);
        $token = $user->createToken('auth_token')->plainTextToken;

        $this->withHeader('Authorization', 'Bearer '.$token)
            ->getJson('/api/business/dashboard')
            ->assertOk()
            ->assertJson(['message' => 'Business dashboard']);
    }

    public function test_delivery_can_access_delivery_route(): void
    {
        $user = User::factory()->create(['role' => 'delivery']);
        $token = $user->createToken('auth_token')->plainTextToken;

        $this->withHeader('Authorization', 'Bearer '.$token)
            ->getJson('/api/delivery/tasks')
            ->assertOk()
            ->assertJson(['message' => 'Delivery tasks']);
    }

    public function test_delivery_cannot_access_client_route(): void
    {
        $user = User::factory()->create(['role' => 'delivery']);
        $token = $user->createToken('auth_token')->plainTextToken;

        $this->withHeader('Authorization', 'Bearer '.$token)
            ->getJson('/api/client/orders')
            ->assertStatus(403);
    }
}

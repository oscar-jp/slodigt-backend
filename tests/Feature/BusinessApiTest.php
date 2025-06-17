<?php

namespace Tests\Feature;

use App\Models\Business;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BusinessApiTest extends TestCase
{
    use RefreshDatabase;
    public function test_business_can_be_created_via_api(): void
    {
        $user = User::factory()->create(['role' => 'business']);
        $token = $user->createToken('auth_token')->plainTextToken;

        $data = Business::factory()->make()->toArray();

        $response = $this->withHeader('Authorization', 'Bearer ' . $token)
            ->postJson('/api/businesses', $data);

        $response->assertCreated()
            ->assertJsonStructure(['business' => ['id', 'name', 'slug']]);

        $this->assertDatabaseHas('businesses', ['name' => $data['name']]);
    }

    public function test_business_can_be_updated_via_api(): void
    {
        $user = User::factory()->create(['role' => 'business']);
        $business = Business::factory()->create(['user_id' => $user->id]);
        $token = $user->createToken('auth_token')->plainTextToken;

        $response = $this->withHeader('Authorization', 'Bearer ' . $token)
            ->putJson('/api/businesses/' . $business->id, ['name' => 'Updated Name']);

        $response->assertOk()
            ->assertJsonStructure(['business' => ['id', 'name']]);

        $this->assertDatabaseHas('businesses', ['id' => $business->id, 'name' => 'Updated Name']);
    }

    public function test_owner_can_invite_and_manage_roles(): void
    {
        $owner = User::factory()->create(['role' => 'business']);
        $business = Business::factory()->create(['user_id' => $owner->id]);
        $user = User::factory()->create();
        $token = $owner->createToken('auth_token')->plainTextToken;

        $invite = $this->withHeader('Authorization', 'Bearer ' . $token)
            ->postJson('/api/businesses/' . $business->id . '/roles', [
                'user_id' => $user->id,
                'role' => 'staff',
            ]);

        $invite->assertCreated()
            ->assertJsonStructure(['role' => ['id', 'business_id', 'user_id', 'role']]);

        $roleId = $invite->json('role.id');

        $update = $this->withHeader('Authorization', 'Bearer ' . $token)
            ->putJson('/api/businesses/' . $business->id . '/roles/' . $roleId, [
                'role' => 'manager',
            ]);

        $update->assertOk()
            ->assertJson(['role' => ['id' => $roleId, 'role' => 'manager']]);

        $delete = $this->withHeader('Authorization', 'Bearer ' . $token)
            ->deleteJson('/api/businesses/' . $business->id . '/roles/' . $roleId);

        $delete->assertStatus(204);

        $this->assertDatabaseMissing('business_user_roles', ['id' => $roleId]);
    }

    public function test_list_public_businesses_with_filters(): void
    {
        $user = User::factory()->create();
        $token = $user->createToken('auth_token')->plainTextToken;

        Business::factory()->for(User::factory(), 'owner')->create(['name' => 'Pizza Place']);
        Business::factory()->for(User::factory(), 'owner')->create(['name' => 'Burger Joint']);

        $response = $this->withHeader('Authorization', 'Bearer ' . $token)
            ->getJson('/api/businesses?search=Pizza');

        $response->assertOk()
            ->assertJsonStructure(['businesses'])
            ->assertJsonCount(1, 'businesses');
    }
}

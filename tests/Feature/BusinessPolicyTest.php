<?php

namespace Tests\Feature;

use App\Models\Business;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BusinessPolicyTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_cannot_update_other_business(): void
    {
        $owner = User::factory()->create(['role' => 'business']);
        $other = User::factory()->create(['role' => 'business']);
        $business = Business::factory()->create(['user_id' => $owner->id]);

        $token = $other->createToken('auth_token')->plainTextToken;

        $this->withHeader('Authorization', 'Bearer '.$token)
            ->putJson('/api/businesses/'.$business->id, [
                'name' => 'New Name',
            ])
            ->assertStatus(403);
    }

    public function test_owner_can_update_their_business(): void
    {
        $owner = User::factory()->create(['role' => 'business']);
        $business = Business::factory()->create(['user_id' => $owner->id]);

        $token = $owner->createToken('auth_token')->plainTextToken;

        $this->withHeader('Authorization', 'Bearer '.$token)
            ->putJson('/api/businesses/'.$business->id, [
                'name' => 'Updated',
            ])
            ->assertOk();
    }
}

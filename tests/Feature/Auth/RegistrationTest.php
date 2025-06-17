<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_new_users_can_register(): void
    {
        $response = $this->postJson('/api/register', [
            'username' => 'testuser',
            'fullname' => 'Test User',
            'password' => 'password',
            'password_confirmation' => 'password',
            'terms_accepted' => true,
            'privacy_accepted' => true,
            'age_verified' => true,
            'consent_data_usage' => true,
        ]);

        $response->assertCreated()
            ->assertJsonStructure([
                'user' => ['id', 'username'],
                'token',
            ]);
    }
}

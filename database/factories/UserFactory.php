<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'username'            => $this->faker->unique()->userName(),
            'fullname'            => $this->faker->name(),
            'email'               => $this->faker->unique()->safeEmail(),
            'email_verified_at'   => now(),
            'password'            => static::$password ??= Hash::make('password'),
            'role'                => $this->faker->randomElement(['user', 'business', 'delivery']),
            // Consentimientos legales simulados
            'terms_accepted_at'   => now(),
            'privacy_accepted_at' => now(),
            'age_verified'        => $this->faker->boolean(),
            'consent_data_usage'  => $this->faker->boolean(),
            'consent_marketing'   => $this->faker->boolean(),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}

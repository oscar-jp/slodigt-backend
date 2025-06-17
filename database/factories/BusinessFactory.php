<?php

namespace Database\Factories;

use App\Models\Business;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Business>
 */
class BusinessFactory extends Factory
{
    protected $model = Business::class;

    public function definition(): array
    {
        $name = $this->faker->company();

        return [
            'user_id'       => null,
            'name'          => $name,
            'slug'          => Str::slug($name) . '-' . Str::random(5),
            'description'   => $this->faker->catchPhrase(),
            'logo_url'      => $this->faker->imageUrl(300, 300, 'business', true),
            'address1'      => $this->faker->streetAddress(),
            'address2'      => $this->faker->secondaryAddress(),
            'city_id'       => null,
            'region_id'     => null,
            'country_id'    => null,
            'latitude'      => $this->faker->latitude(),
            'longitude'     => $this->faker->longitude(),
            'contact_email' => $this->faker->companyEmail(),
            'contact_phone' => $this->faker->phoneNumber(),
            'website_url'   => $this->faker->url(),
            'is_approved'   => true,
            'approved_at'   => now(),
            'approved_by'   => null,
            'rating'        => 0,
            'rating_count'  => 0,
            'status'        => 'active',
        ];
    }
}

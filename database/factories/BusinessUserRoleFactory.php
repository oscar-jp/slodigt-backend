<?php

namespace Database\Factories;

use App\Models\BusinessUserRole;
use App\Models\Business;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class BusinessUserRoleFactory extends Factory
{
    protected $model = BusinessUserRole::class;

    public function definition(): array
    {
        return [
            'business_id' => Business::factory(),
            'user_id' => User::factory(),
            'role' => 'staff',
        ];
    }
}

<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Usuarios de ejemplo con diferentes roles
        User::factory()->create([
            'username' => 'demo_user',
            'fullname' => 'Demo Cliente',
            'email'    => 'user@example.com',
            'role'     => 'user',
        ]);

        User::factory()->create([
            'username' => 'demo_business',
            'fullname' => 'Demo Negocio',
            'email'    => 'business@example.com',
            'role'     => 'business',
        ]);

        User::factory()->create([
            'username' => 'demo_delivery',
            'fullname' => 'Demo Repartidor',
            'email'    => 'delivery@example.com',
            'role'     => 'delivery',
        ]);
    }
}

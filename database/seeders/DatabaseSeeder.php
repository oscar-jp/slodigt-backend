<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Business;
use App\Models\BusinessUserRole;
use App\Models\BusinessReview;
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
        $client = User::factory()->create([
            'username' => 'demo_user',
            'fullname' => 'Demo Cliente',
            'email'    => 'user@example.com',
            'role'     => 'user',
        ]);

        $owner1 = User::factory()->create([
            'username' => 'demo_business1',
            'fullname' => 'Demo Negocio 1',
            'email'    => 'business1@example.com',
            'role'     => 'business',
        ]);

        $owner2 = User::factory()->create([
            'username' => 'demo_business2',
            'fullname' => 'Demo Negocio 2',
            'email'    => 'business2@example.com',
            'role'     => 'business',
        ]);

        User::factory()->create([
            'username' => 'demo_delivery',
            'fullname' => 'Demo Repartidor',
            'email'    => 'delivery@example.com',
            'role'     => 'delivery',
        ]);

        // Negocios de ejemplo vinculados a los propietarios
        $business1 = Business::factory()->create(['user_id' => $owner1->id]);
        $business2 = Business::factory()->create(['user_id' => $owner2->id]);

        BusinessUserRole::create([
            'business_id' => $business1->id,
            'user_id'     => $owner1->id,
            'role'        => 'owner',
        ]);

        BusinessUserRole::create([
            'business_id' => $business2->id,
            'user_id'     => $owner2->id,
            'role'        => 'owner',
        ]);

        BusinessReview::create([
            'business_id' => $business1->id,
            'user_id'     => $client->id,
            'rating'      => 4.5,
            'comment'     => 'Gran servicio!',
        ]);
    }
}

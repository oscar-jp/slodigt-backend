<?php

namespace Database\Seeders;

use App\Models\Business;
use App\Models\BusinessDeliveryLink;
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
        $client = User::factory()->create([
            'username' => 'demo_user',
            'fullname' => 'Demo Cliente',
            'email' => 'user@example.com',
            'role' => 'user',
        ]);

        $owner1 = User::factory()->create([
            'username' => 'demo_business1',
            'fullname' => 'Demo Negocio 1',
            'email' => 'business1@example.com',
            'role' => 'business',
        ]);

        $owner2 = User::factory()->create([
            'username' => 'demo_business2',
            'fullname' => 'Demo Negocio 2',
            'email' => 'business2@example.com',
            'role' => 'business',
        ]);

        $courier = User::factory()->create([
            'username' => 'demo_delivery',
            'fullname' => 'Demo Repartidor',
            'email' => 'delivery@example.com',
            'role' => 'delivery',
        ]);

        // Negocios de ejemplo vinculados a los propietarios
        $business1 = $owner1->ownedBusinesses()->save(Business::factory()->make());
        $business2 = $owner2->ownedBusinesses()->save(Business::factory()->make());

        $owner1->businessRoles()->create([
            'business_id' => $business1->id,
            'role' => 'owner',
        ]);

        $owner2->businessRoles()->create([
            'business_id' => $business2->id,
            'role' => 'owner',
        ]);

        $client->businessReviews()->create([
            'business_id' => $business1->id,
            'rating' => 4.5,
            'comment' => 'Gran servicio!',
        ]);

        // Enlaces de ejemplo entre negocios y el repartidor
        BusinessDeliveryLink::create([
            'business_id' => $business1->id,
            'courier_id' => $courier->id,
            'is_favorite' => true,
        ]);

        BusinessDeliveryLink::create([
            'business_id' => $business2->id,
            'courier_id' => $courier->id,
            'is_blocked' => false,
        ]);
    }
}

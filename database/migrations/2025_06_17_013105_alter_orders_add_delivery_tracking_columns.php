<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('delivery_method')->nullable()->after('order_type');
            $table->string('address')->nullable()->after('delivery_method');
            $table->decimal('latitude', 10, 6)->nullable()->after('address');
            $table->decimal('longitude', 10, 6)->nullable()->after('latitude');
            $table->foreignId('assigned_delivery_id')->nullable()->constrained('deliveries')->after('notes');
            $table->timestamp('delivered_at')->nullable()->after('assigned_delivery_id');
            $table->timestamp('canceled_at')->nullable()->after('delivered_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropForeign(['assigned_delivery_id']);
            $table->dropColumn([
                'delivery_method',
                'address',
                'latitude',
                'longitude',
                'assigned_delivery_id',
                'delivered_at',
                'canceled_at',
            ]);
        });
    }
};

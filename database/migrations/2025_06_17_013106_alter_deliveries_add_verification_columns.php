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
        Schema::table('deliveries', function (Blueprint $table) {
            $table->timestamp('picked_up_at')->nullable()->after('status');
            $table->string('pickup_code', 10)->nullable()->after('picked_up_at');
            $table->timestamp('pickup_verified_at')->nullable()->after('pickup_code');
            $table->string('delivery_code', 10)->nullable()->after('pickup_verified_at');
            $table->timestamp('delivery_verified_at')->nullable()->after('delivery_code');
            $table->foreignId('last_track_id')->nullable()->after('delivery_verified_at')
                ->constrained('delivery_tracks')->nullOnDelete();
            $table->timestamp('canceled_at')->nullable()->after('delivered_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('deliveries', function (Blueprint $table) {
            $table->dropForeign(['last_track_id']);
            $table->dropColumn([
                'picked_up_at',
                'pickup_code',
                'pickup_verified_at',
                'delivery_code',
                'delivery_verified_at',
                'last_track_id',
                'canceled_at',
            ]);
        });
    }
};

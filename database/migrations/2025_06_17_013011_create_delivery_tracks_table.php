<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('delivery_tracks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('delivery_id')->constrained('deliveries')->onDelete('cascade');
            $table->decimal('latitude', 10, 6);
            $table->decimal('longitude', 10, 6);
            $table->timestamp('recorded_at')->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('delivery_tracks');
    }
};

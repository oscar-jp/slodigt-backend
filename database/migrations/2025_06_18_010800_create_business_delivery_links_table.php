<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('business_delivery_links', function (Blueprint $table) {
            $table->id();
            $table->foreignId('business_id')->constrained('businesses')->onDelete('cascade');
            $table->foreignId('courier_id')->constrained('users')->onDelete('cascade');
            $table->boolean('is_favorite')->default(false);
            $table->boolean('is_blocked')->default(false);
            $table->timestamps();

            $table->unique(['business_id', 'courier_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('business_delivery_links');
    }
};

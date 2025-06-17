<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('prepaid_cards', function (Blueprint $table) {
            $table->id();
            $table->string('code', 50)->unique();
            $table->string('pin', 64);
            $table->decimal('amount', 10, 2);
            $table->foreignId('business_id')->constrained('users');
            $table->foreignId('user_id')->nullable()->constrained('users');
            $table->enum('status', ['inactive', 'active', 'redeemed', 'expired'])->default('inactive');
            $table->timestamp('activated_at')->nullable();
            $table->timestamp('redeemed_at')->nullable();
            $table->timestamp('expires_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('prepaid_cards');
    }
};

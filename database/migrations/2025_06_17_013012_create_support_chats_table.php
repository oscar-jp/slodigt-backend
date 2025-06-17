<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('support_chats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('agent_id')->nullable()->constrained('users');
            $table->foreignId('order_id')->nullable()->constrained('orders');
            $table->foreignId('recharge_id')->nullable()->constrained('recharges');
            $table->enum('status', ['open', 'closed'])->default('open');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('support_chats');
    }
};

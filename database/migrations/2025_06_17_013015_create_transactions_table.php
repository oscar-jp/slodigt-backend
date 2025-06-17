<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('account_id')->constrained('accounts');
            $table->foreignId('source_account_id')->nullable()->constrained('accounts');
            $table->enum('type', ['recharge', 'transfer_in', 'transfer_out', 'purchase', 'refund']);
            $table->decimal('amount', 10, 2);
            $table->string('description')->nullable();
            $table->decimal('balance_after', 10, 2);
            $table->foreignId('recharge_id')->nullable()->constrained('recharges');
            $table->foreignId('order_id')->nullable()->constrained('orders');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->enum('payment_method', ['cash', 'balance', 'card'])->default('cash')->after('total_amount');
            $table->enum('order_type', ['delivery', 'pickup'])->default('delivery')->after('payment_method');
            $table->string('delivery_address')->nullable()->after('order_type');
            $table->text('notes')->nullable()->after('delivery_address');
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['payment_method', 'order_type', 'delivery_address', 'notes']);
        });
    }
};

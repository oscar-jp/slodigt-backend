<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string('slug')->unique()->after('name');
            $table->string('sku', 50)->nullable()->after('slug');
            $table->decimal('weight', 8, 2)->nullable()->after('stock');
            $table->string('barcode', 50)->nullable()->after('weight');
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['slug', 'sku', 'weight', 'barcode']);
        });
    }
};

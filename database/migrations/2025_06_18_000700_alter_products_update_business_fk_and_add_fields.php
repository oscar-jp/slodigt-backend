<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['business_id']);
            $table->unsignedBigInteger('business_id')->change();
            $table->foreign('business_id')->references('id')->on('businesses');
            $table->string('image_main_url')->nullable()->after('barcode');
            $table->decimal('rating', 3, 2)->default(0)->after('image_main_url');
            $table->boolean('is_available')->default(true)->after('status');
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['image_main_url', 'rating', 'is_available']);
            $table->dropForeign(['business_id']);
            $table->unsignedBigInteger('business_id')->change();
            $table->foreign('business_id')->references('id')->on('users');
        });
    }
};

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
        Schema::table('businesses', function (Blueprint $table) {
            $table->string('address1')->nullable()->after('logo_url');
            $table->string('address2')->nullable()->after('address1');
            $table->foreignId('city_id')->nullable()->after('address2')->constrained('cities');
            $table->foreignId('region_id')->nullable()->after('city_id')->constrained('regions');
            $table->foreignId('country_id')->nullable()->after('region_id')->constrained('countries');
            $table->decimal('latitude', 10, 6)->nullable()->after('country_id');
            $table->decimal('longitude', 10, 6)->nullable()->after('latitude');
            $table->string('contact_email')->nullable()->after('longitude');
            $table->string('contact_phone', 20)->nullable()->after('contact_email');
            $table->string('website_url')->nullable()->after('contact_phone');
            $table->boolean('is_approved')->default(false)->after('status');
            $table->timestamp('approved_at')->nullable()->after('is_approved');
            $table->foreignId('approved_by')->nullable()->after('approved_at')->constrained('users');
            $table->integer('rating_count')->default(0)->after('rating');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('businesses', function (Blueprint $table) {
            $table->dropForeign(['city_id']);
            $table->dropForeign(['region_id']);
            $table->dropForeign(['country_id']);
            $table->dropForeign(['approved_by']);
            $table->dropColumn([
                'address1',
                'address2',
                'city_id',
                'region_id',
                'country_id',
                'latitude',
                'longitude',
                'contact_email',
                'contact_phone',
                'website_url',
                'is_approved',
                'approved_at',
                'approved_by',
                'rating_count',
            ]);
        });
    }
};

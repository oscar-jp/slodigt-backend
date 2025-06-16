<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // ✅ NUEVA ESTRUCTURA USERS
        Schema::create('users', function (Blueprint $table) {
            $table->id();

            $table->string('username', 50)->unique();
            $table->string('fullname', 100);
            $table->string('lastname', 100)->nullable();
            $table->string('email', 255)->nullable()->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('phone', 20)->nullable();
            $table->enum('role', ['user', 'business', 'delivery'])->default('user');

            $table->string('address1')->nullable();
            $table->string('address2')->nullable();
            $table->foreignId('city_id')->nullable()->constrained('cities');
            $table->foreignId('region_id')->nullable()->constrained('regions');
            $table->foreignId('country_id')->nullable()->constrained('countries');
            $table->decimal('latitude', 10, 6)->nullable();
            $table->decimal('longitude', 10, 6)->nullable();

            $table->string('photo_url')->nullable();
            $table->boolean('identity_verified')->default(false);
            $table->enum('delivery_level', ['bronze', 'silver', 'gold'])->nullable();
            $table->decimal('rating', 3, 2)->default(0);
            $table->boolean('active_status')->default(false);
            $table->integer('daily_hours_limit')->default(0);
            $table->decimal('tips_balance', 10, 2)->default(0);
            $table->decimal('balance', 10, 2)->default(0);

            // Consentimientos legales
            $table->timestamp('terms_accepted_at')->nullable();
            $table->timestamp('privacy_accepted_at')->nullable();
            $table->boolean('age_verified')->default(false);
            $table->boolean('consent_data_usage')->default(false);
            $table->boolean('consent_marketing')->default(false);

            $table->timestamps();
        });

        // Estas tablas sí puedes dejarlas igual 👇
        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('prepaid_cards', function (Blueprint $table) {
            $table->char('currency', 3)->default('USD')->after('amount');
            $table->text('notes')->nullable()->after('expires_at');
        });
    }

    public function down(): void
    {
        Schema::table('prepaid_cards', function (Blueprint $table) {
            $table->dropColumn(['currency', 'notes']);
        });
    }
};

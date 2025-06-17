<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('recharges', function (Blueprint $table) {
            $table->enum('method', ['bank', 'agent', 'card'])->default('bank')->after('amount');
            $table->decimal('transaction_fee', 10, 2)->default(0)->after('method');
            $table->text('notes')->nullable()->after('receipt_url');
        });
    }

    public function down(): void
    {
        Schema::table('recharges', function (Blueprint $table) {
            $table->dropColumn(['method', 'transaction_fee', 'notes']);
        });
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::rename('product_bundles', 'product_bundle_items');
    }

    public function down(): void
    {
        Schema::rename('product_bundle_items', 'product_bundles');
    }
};

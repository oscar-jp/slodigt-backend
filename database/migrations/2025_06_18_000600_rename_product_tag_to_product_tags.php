<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::rename('product_tag', 'product_tags');
    }

    public function down(): void
    {
        Schema::rename('product_tags', 'product_tag');
    }
};

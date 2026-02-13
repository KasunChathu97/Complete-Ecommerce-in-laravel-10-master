<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('products', 'free_shipping') || !Schema::hasColumn('products', 'free_shipping_enabled')) {
            return;
        }

        // Some databases have both the new column (free_shipping) and a legacy column (free_shipping_enabled).
        // Normalize data so both columns stay consistent.
        DB::statement(
            "UPDATE products\n".
            "SET free_shipping = (free_shipping = 1 OR free_shipping_enabled = 1),\n".
            "    free_shipping_enabled = (free_shipping = 1 OR free_shipping_enabled = 1)"
        );
    }

    public function down(): void
    {
        // No-op: we can't safely infer the previous state.
    }
};

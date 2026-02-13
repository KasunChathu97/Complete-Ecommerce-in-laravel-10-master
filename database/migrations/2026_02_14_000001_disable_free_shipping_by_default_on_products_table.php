<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Make sure free shipping is NOT enabled by default.
        if (Schema::hasColumn('products', 'free_shipping')) {
            DB::table('products')->update(['free_shipping' => 0]);
        }

        // Some databases contain a legacy free_shipping_enabled column.
        if (Schema::hasColumn('products', 'free_shipping_enabled')) {
            DB::table('products')->update(['free_shipping_enabled' => 0]);
        }
    }

    public function down(): void
    {
        // No-op: we can't safely restore previous free shipping flags.
    }
};

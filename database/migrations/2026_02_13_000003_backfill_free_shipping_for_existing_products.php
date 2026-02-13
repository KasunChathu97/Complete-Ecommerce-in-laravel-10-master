<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('products', 'free_shipping')) {
            return;
        }

        // Enable free shipping for previously created products (existing rows)
        DB::table('products')->where('free_shipping', 0)->update(['free_shipping' => 1]);
    }

    public function down(): void
    {
        if (!Schema::hasColumn('products', 'free_shipping')) {
            return;
        }

        DB::table('products')->update(['free_shipping' => 0]);
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('products')) {
            return;
        }

        Schema::table('products', function (Blueprint $table) {
            if (!Schema::hasColumn('products', 'purchase_price')) {
                $table->decimal('purchase_price', 12, 2)->nullable()->after('price');
            }

            if (!Schema::hasColumn('products', 'sale_price')) {
                $table->decimal('sale_price', 12, 2)->nullable()->after('purchase_price');
            }
        });

        // Backfill for existing rows
        if (Schema::hasColumn('products', 'sale_price')) {
            DB::table('products')
                ->whereNull('sale_price')
                ->update(['sale_price' => DB::raw('price')]);
        }

        if (Schema::hasColumn('products', 'purchase_price') && Schema::hasColumn('products', 'wholesale_price')) {
            DB::table('products')
                ->whereNull('purchase_price')
                ->whereNotNull('wholesale_price')
                ->update(['purchase_price' => DB::raw('wholesale_price')]);
        }
    }
};

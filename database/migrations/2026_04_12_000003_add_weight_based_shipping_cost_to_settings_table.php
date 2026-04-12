<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('settings', 'shipping_cost_upto_1kg')) {
            Schema::table('settings', function (Blueprint $table) {
                $table->unsignedInteger('shipping_cost_upto_1kg')->default(350);
            });
        }

        if (!Schema::hasColumn('settings', 'shipping_cost_over_1kg_extra')) {
            Schema::table('settings', function (Blueprint $table) {
                $table->unsignedInteger('shipping_cost_over_1kg_extra')->default(80);
            });
        }
    }

    public function down(): void
    {
        $columnsToDrop = [];

        foreach (['shipping_cost_upto_1kg', 'shipping_cost_over_1kg_extra'] as $column) {
            if (Schema::hasColumn('settings', $column)) {
                $columnsToDrop[] = $column;
            }
        }

        if (!empty($columnsToDrop)) {
            Schema::table('settings', function (Blueprint $table) use ($columnsToDrop) {
                $table->dropColumn($columnsToDrop);
            });
        }
    }
};

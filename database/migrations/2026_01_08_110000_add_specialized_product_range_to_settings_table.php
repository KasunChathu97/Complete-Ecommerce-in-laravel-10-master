<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('settings', 'specialized_product_range')) {
            Schema::table('settings', function (Blueprint $table) {
                $table->longText('specialized_product_range')->nullable()->after('commitment_energy_independence');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('settings', 'specialized_product_range')) {
            Schema::table('settings', function (Blueprint $table) {
                $table->dropColumn('specialized_product_range');
            });
        }
    }
};

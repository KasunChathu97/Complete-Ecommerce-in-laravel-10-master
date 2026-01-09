<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('settings', 'why_choose_delimach_lanka')) {
            Schema::table('settings', function (Blueprint $table) {
                $table->longText('why_choose_delimach_lanka')->nullable()->after('specialized_product_range');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('settings', 'why_choose_delimach_lanka')) {
            Schema::table('settings', function (Blueprint $table) {
                $table->dropColumn('why_choose_delimach_lanka');
            });
        }
    }
};

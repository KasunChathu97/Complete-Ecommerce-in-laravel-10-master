<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('settings', 'vision')) {
            Schema::table('settings', function (Blueprint $table) {
                $table->longText('vision')->nullable()->after('description');
            });
        }

        if (!Schema::hasColumn('settings', 'mission')) {
            Schema::table('settings', function (Blueprint $table) {
                $table->longText('mission')->nullable()->after('vision');
            });
        }
    }

    public function down(): void
    {
        $columnsToDrop = [];

        foreach (['mission', 'vision'] as $column) {
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

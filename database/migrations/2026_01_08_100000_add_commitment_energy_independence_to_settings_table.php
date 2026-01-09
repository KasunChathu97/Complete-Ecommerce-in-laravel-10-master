<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('settings', 'commitment_energy_independence')) {
            Schema::table('settings', function (Blueprint $table) {
                $table->longText('commitment_energy_independence')->nullable()->after('mission');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('settings', 'commitment_energy_independence')) {
            Schema::table('settings', function (Blueprint $table) {
                $table->dropColumn('commitment_energy_independence');
            });
        }
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('settings', 'facebook')) {
            Schema::table('settings', function (Blueprint $table) {
                $table->string('facebook')->nullable()->after('email');
            });
        }

        if (!Schema::hasColumn('settings', 'instagram')) {
            Schema::table('settings', function (Blueprint $table) {
                $table->string('instagram')->nullable()->after('facebook');
            });
        }

        if (!Schema::hasColumn('settings', 'youtube')) {
            Schema::table('settings', function (Blueprint $table) {
                $table->string('youtube')->nullable()->after('instagram');
            });
        }

        if (!Schema::hasColumn('settings', 'twitter')) {
            Schema::table('settings', function (Blueprint $table) {
                $table->string('twitter')->nullable()->after('youtube');
            });
        }

        if (!Schema::hasColumn('settings', 'whatsapp')) {
            Schema::table('settings', function (Blueprint $table) {
                $table->string('whatsapp')->nullable()->after('twitter');
            });
        }
    }

    public function down(): void
    {
        $columnsToDrop = [];

        foreach (['facebook', 'instagram', 'youtube', 'twitter', 'whatsapp'] as $column) {
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

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ReplaceTrackingWithCourierTrackingOnOrdersTable extends Migration
{
    public function up()
    {
        // 1) Add new manual courier tracking column.
        Schema::table('orders', function (Blueprint $table) {
            if (!Schema::hasColumn('orders', 'courier_tracking_number')) {
                $table->string('courier_tracking_number', 150)->nullable()->after('courier_name');
            }
        });

        // 2) Backfill from legacy tracking_number if present.
        if (Schema::hasColumn('orders', 'tracking_number')) {
            DB::statement("UPDATE `orders` SET `courier_tracking_number` = `tracking_number` WHERE `courier_tracking_number` IS NULL AND `tracking_number` IS NOT NULL AND `tracking_number` != ''");
        }

        // 3) Drop legacy columns we no longer use.
        Schema::table('orders', function (Blueprint $table) {
            if (Schema::hasColumn('orders', 'courier_tracking_message')) {
                $table->dropColumn('courier_tracking_message');
            }

            if (Schema::hasColumn('orders', 'tracking_number')) {
                $table->dropColumn('tracking_number');
            }
        });
    }

    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            // Intentionally left minimal to avoid unsafe drops in shared DBs.
        });
    }
}

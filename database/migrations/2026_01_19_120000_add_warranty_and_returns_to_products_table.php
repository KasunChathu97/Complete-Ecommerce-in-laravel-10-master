<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddWarrantyAndReturnsToProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            if (!Schema::hasColumn('products', 'warranty')) {
                $table->text('warranty')->nullable()->after('description');
            }
            if (!Schema::hasColumn('products', 'returns')) {
                $table->text('returns')->nullable()->after('warranty');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            if (Schema::hasColumn('products', 'warranty')) {
                $table->dropColumn('warranty');
            }
            if (Schema::hasColumn('products', 'returns')) {
                $table->dropColumn('returns');
            }
        });
    }
}

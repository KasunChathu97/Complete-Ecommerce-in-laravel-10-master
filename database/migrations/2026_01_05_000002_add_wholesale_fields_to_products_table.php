<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddWholesaleFieldsToProductsTable extends Migration
{
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            if (!Schema::hasColumn('products', 'wholesale_price')) {
                $table->decimal('wholesale_price', 12, 2)->nullable()->after('price');
            }
            if (!Schema::hasColumn('products', 'wholesale_min_qty')) {
                $table->unsignedInteger('wholesale_min_qty')->default(0)->after('wholesale_price');
            }
        });
    }

    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            // Intentionally left minimal to avoid unsafe drops in shared DBs.
        });
    }
}

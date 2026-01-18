<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBulkDiscountAmountTypeToProductsTable extends Migration
{
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            if (!Schema::hasColumn('products', 'bulk_discount_amount_type')) {
                $table->enum('bulk_discount_amount_type', ['fixed', 'percent'])->default('fixed')->after('bulk_discount_amount');
            }
        });
    }

    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            if (Schema::hasColumn('products', 'bulk_discount_amount_type')) {
                $table->dropColumn('bulk_discount_amount_type');
            }
        });
    }
}

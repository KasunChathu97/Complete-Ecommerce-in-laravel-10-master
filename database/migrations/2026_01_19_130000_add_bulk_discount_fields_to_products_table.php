<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBulkDiscountFieldsToProductsTable extends Migration
{
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            if (!Schema::hasColumn('products', 'bulk_discount_type')) {
                $table->enum('bulk_discount_type', ['none', 'qty', 'value'])->default('none')->after('returns');
            }
            if (!Schema::hasColumn('products', 'bulk_discount_threshold')) {
                $table->integer('bulk_discount_threshold')->nullable()->after('bulk_discount_type');
            }
            if (!Schema::hasColumn('products', 'bulk_discount_amount')) {
                $table->decimal('bulk_discount_amount', 12, 2)->nullable()->after('bulk_discount_threshold');
            }
        });
    }

    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            if (Schema::hasColumn('products', 'bulk_discount_type')) {
                $table->dropColumn('bulk_discount_type');
            }
            if (Schema::hasColumn('products', 'bulk_discount_threshold')) {
                $table->dropColumn('bulk_discount_threshold');
            }
            if (Schema::hasColumn('products', 'bulk_discount_amount')) {
                $table->dropColumn('bulk_discount_amount');
            }
        });
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCourierIdAndSellerEditCountToProductsTable extends Migration
{
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->unsignedBigInteger('courier_id')->nullable()->after('brand_id');
            $table->unsignedTinyInteger('seller_edit_count')->default(0)->after('courier_id');

            $table->foreign('courier_id')
                ->references('id')
                ->on('couriers')
                ->nullOnDelete();
        });
    }

    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['courier_id']);
            $table->dropColumn(['courier_id', 'seller_edit_count']);
        });
    }
}
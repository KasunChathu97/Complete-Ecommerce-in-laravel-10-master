<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sales_admin_stock_transfers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sales_admin_id');
            $table->unsignedBigInteger('product_id');
            $table->integer('quantity');
            $table->unsignedBigInteger('created_by')->nullable();
            $table->timestamps();

            $table->foreign('sales_admin_id')->references('id')->on('users')->onDelete('CASCADE');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('CASCADE');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('SET NULL');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sales_admin_stock_transfers');
    }
};

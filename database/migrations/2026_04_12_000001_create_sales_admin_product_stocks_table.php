<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sales_admin_product_stocks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sales_admin_id');
            $table->unsignedBigInteger('product_id');
            $table->integer('quantity')->default(0);
            $table->timestamps();

            $table->unique(['sales_admin_id', 'product_id']);
            $table->foreign('sales_admin_id')->references('id')->on('users')->onDelete('CASCADE');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('CASCADE');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sales_admin_product_stocks');
    }
};

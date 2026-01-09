<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShipmentTrackingsTable extends Migration
{
    public function up()
    {
        Schema::create('shipment_trackings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->string('status', 50);
            $table->string('location')->nullable();
            $table->text('description')->nullable();
            $table->timestamp('event_time')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->timestamps();

            $table->foreign('order_id')->references('id')->on('orders')->onDelete('CASCADE');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('SET NULL');
        });
    }

    public function down()
    {
        Schema::dropIfExists('shipment_trackings');
    }
}

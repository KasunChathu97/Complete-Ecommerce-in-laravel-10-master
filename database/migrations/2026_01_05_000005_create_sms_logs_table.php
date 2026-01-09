<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSmsLogsTable extends Migration
{
    public function up()
    {
        Schema::create('sms_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id')->nullable();
            $table->string('phone', 50);
            $table->text('message');
            $table->string('provider', 100)->nullable();
            $table->string('status', 30)->default('queued');
            $table->timestamp('sent_at')->nullable();
            $table->text('provider_response')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->timestamps();

            $table->foreign('order_id')->references('id')->on('orders')->onDelete('SET NULL');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('SET NULL');
        });
    }

    public function down()
    {
        Schema::dropIfExists('sms_logs');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCommerceExtensionsToOrdersTable extends Migration
{
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            if (!Schema::hasColumn('orders', 'order_source')) {
                $table->string('order_source', 30)->default('online')->after('status');
            }
            if (!Schema::hasColumn('orders', 'sales_staff_id')) {
                $table->unsignedBigInteger('sales_staff_id')->nullable()->after('user_id');
                $table->foreign('sales_staff_id')->references('id')->on('users')->onDelete('SET NULL');
            }
            if (!Schema::hasColumn('orders', 'social_platform')) {
                $table->string('social_platform', 50)->nullable()->after('order_source');
            }
            if (!Schema::hasColumn('orders', 'social_order_ref')) {
                $table->string('social_order_ref', 100)->nullable()->after('social_platform');
            }
            if (!Schema::hasColumn('orders', 'courier_name')) {
                $table->string('courier_name', 100)->nullable()->after('shipping_id');
            }
            if (!Schema::hasColumn('orders', 'tracking_number')) {
                $table->string('tracking_number', 100)->nullable()->after('courier_name');
            }
            if (!Schema::hasColumn('orders', 'shipped_at')) {
                $table->timestamp('shipped_at')->nullable()->after('tracking_number');
            }
            if (!Schema::hasColumn('orders', 'delivered_at')) {
                $table->timestamp('delivered_at')->nullable()->after('shipped_at');
            }
            if (!Schema::hasColumn('orders', 'offline_receipt_no')) {
                $table->string('offline_receipt_no', 100)->nullable()->after('order_number');
            }
            if (!Schema::hasColumn('orders', 'payment_gateway')) {
                $table->string('payment_gateway', 50)->nullable()->after('payment_method');
            }
            if (!Schema::hasColumn('orders', 'payment_reference')) {
                $table->string('payment_reference', 150)->nullable()->after('payment_gateway');
            }
            if (!Schema::hasColumn('orders', 'notes')) {
                $table->text('notes')->nullable()->after('address2');
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

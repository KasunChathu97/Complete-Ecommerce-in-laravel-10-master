<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::table('carts', function (Blueprint $table) {
            $table->decimal('shipping_cost', 10, 2)->nullable()->after('amount');
        });
    }
    public function down() {
        Schema::table('carts', function (Blueprint $table) {
            $table->dropColumn('shipping_cost');
        });
    }
};

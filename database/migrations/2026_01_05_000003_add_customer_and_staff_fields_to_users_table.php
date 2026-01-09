<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCustomerAndStaffFieldsToUsersTable extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'customer_type')) {
                $table->string('customer_type', 30)->default('retail')->after('role');
            }
            if (!Schema::hasColumn('users', 'company_name')) {
                $table->string('company_name')->nullable()->after('name');
            }
            if (!Schema::hasColumn('users', 'is_sales_staff')) {
                $table->boolean('is_sales_staff')->default(false)->after('customer_type');
            }
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // Intentionally left minimal to avoid unsafe drops in shared DBs.
        });
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        if (!Schema::hasTable('users') || !Schema::hasColumn('users', 'role')) {
            return;
        }

        $driver = DB::getDriverName();

        // Ensure the role column can store additional roles like 'sales_admin'.
        // The original project used an enum('admin','user'); later code introduced staff/salesman.
        // We convert to a VARCHAR for forward compatibility without requiring doctrine/dbal.
        try {
            if (in_array($driver, ['mysql', 'mariadb'], true)) {
                DB::statement("ALTER TABLE `users` MODIFY `role` VARCHAR(30) NOT NULL DEFAULT 'user'");
            } elseif ($driver === 'pgsql') {
                DB::statement("ALTER TABLE users ALTER COLUMN role TYPE VARCHAR(30)");
                DB::statement("ALTER TABLE users ALTER COLUMN role SET DEFAULT 'user'");
                DB::statement("UPDATE users SET role = 'user' WHERE role IS NULL");
                DB::statement("ALTER TABLE users ALTER COLUMN role SET NOT NULL");
            } elseif ($driver === 'sqlsrv') {
                DB::statement("ALTER TABLE users ALTER COLUMN role VARCHAR(30) NOT NULL");
                // SQL Server default constraint handling is DB-specific; skip.
            }
        } catch (Throwable $e) {
            // If the ALTER fails (already varchar, permissions, etc.), continue with data backfill.
        }

        // Backfill legacy roles into the new sales_admin role (if they exist).
        DB::table('users')
            ->whereIn('role', ['staff', 'salesman'])
            ->update([
                'role' => 'sales_admin',
            ]);

        if (Schema::hasColumn('users', 'is_sales_staff')) {
            DB::table('users')
                ->where('role', 'sales_admin')
                ->update(['is_sales_staff' => 1]);
        }
    }

    public function down(): void
    {
        // Intentionally non-destructive.
    }
};

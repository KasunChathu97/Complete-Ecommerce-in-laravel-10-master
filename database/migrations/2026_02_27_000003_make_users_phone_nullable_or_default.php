<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        if (!Schema::hasTable('users') || !Schema::hasColumn('users', 'phone')) {
            return;
        }

        $driver = DB::getDriverName();

        // Ensure inserts won't fail if phone is omitted.
        try {
            if (in_array($driver, ['mysql', 'mariadb'], true)) {
                DB::statement("ALTER TABLE `users` MODIFY `phone` VARCHAR(50) NULL DEFAULT ''");
                DB::statement("UPDATE `users` SET `phone`='' WHERE `phone` IS NULL");
            } elseif ($driver === 'pgsql') {
                DB::statement("ALTER TABLE users ALTER COLUMN phone DROP NOT NULL");
                DB::statement("ALTER TABLE users ALTER COLUMN phone SET DEFAULT ''");
                DB::statement("UPDATE users SET phone='' WHERE phone IS NULL");
            } elseif ($driver === 'sqlsrv') {
                // SQL Server default constraint names vary; keep best-effort and avoid failure.
                DB::statement("ALTER TABLE users ALTER COLUMN phone VARCHAR(50) NULL");
            }
        } catch (Throwable $e) {
            // Best-effort only.
        }
    }

    public function down(): void
    {
        // Non-destructive.
    }
};

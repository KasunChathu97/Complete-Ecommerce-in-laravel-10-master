<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // The original schema used an ENUM for `orders.status` (new, process, delivered, cancel).
        // To support additional statuses like `pending` without repeated enum migrations,
        // convert it to a VARCHAR.
        $driver = DB::getDriverName();

        // MySQL / MariaDB: ENUM needs an explicit ALTER. Converting to VARCHAR removes the enum restriction.
        if (in_array($driver, ['mysql', 'mariadb'], true)) {
            DB::statement("ALTER TABLE `orders` MODIFY `status` VARCHAR(20) NOT NULL DEFAULT 'new'");
        }

        // For sqlite/pgsql/sqlsrv, this migration is a no-op; those drivers either don't enforce enum
        // the same way or would require driver-specific DDL.
    }

    public function down(): void
    {
        $driver = DB::getDriverName();

        if (in_array($driver, ['mysql', 'mariadb'], true)) {
            DB::statement("ALTER TABLE `orders` MODIFY `status` ENUM('new','process','delivered','cancel') NOT NULL DEFAULT 'new'");
        }
    }
};

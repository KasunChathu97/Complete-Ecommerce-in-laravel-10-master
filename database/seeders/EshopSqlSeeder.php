<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EshopSqlSeeder extends Seeder
{
    public function run(): void
    {
        $defaultPath = base_path('sql/eshop_db.sql');
        $path = (string) (env('ESHOP_SQL_SEED_PATH', $defaultPath) ?: $defaultPath);

        if (!is_file($path)) {
            $this->command?->warn('EshopSqlSeeder: SQL file not found at: '.$path);
            $this->command?->warn('Set ESHOP_SQL_SEED_PATH or place the dump at sql/eshop_db.sql');
            return;
        }

        $sql = file_get_contents($path);
        if ($sql === false || trim($sql) === '') {
            $this->command?->warn('EshopSqlSeeder: SQL file is empty/unreadable: '.$path);
            return;
        }

        // Import only data rows (INSERT statements), not CREATE/DROP statements.
        preg_match_all('/\bINSERT\s+INTO\b.*?;\s*/is', $sql, $matches);
        $statements = $matches[0] ?? [];

        if (count($statements) === 0) {
            $this->command?->warn('EshopSqlSeeder: No INSERT statements found in: '.$path);
            return;
        }

        $this->command?->info('EshopSqlSeeder: Importing '.count($statements).' INSERT statements from '.$path);

        DB::beginTransaction();
        try {
            // Helps when inserts rely on FK order.
            DB::statement('SET FOREIGN_KEY_CHECKS=0');

            foreach ($statements as $stmt) {
                $stmt = trim($stmt);
                if ($stmt === '') {
                    continue;
                }
                DB::statement($stmt);
            }

            DB::statement('SET FOREIGN_KEY_CHECKS=1');
            DB::commit();

            $this->command?->info('EshopSqlSeeder: Import completed.');
        } catch (\Throwable $e) {
            DB::rollBack();
            try {
                DB::statement('SET FOREIGN_KEY_CHECKS=1');
            } catch (\Throwable $ignored) {
                // ignore
            }
            $this->command?->error('EshopSqlSeeder: Import failed: '.$e->getMessage());
            throw $e;
        }
    }
}

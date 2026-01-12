<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(SettingTableSeeder::class);
        $this->call(CouponSeeder::class);

        // Optional: import demo data from sql/eshop_db.sql (INSERT statements only)
        // Enable by setting IMPORT_ESHOP_SQL_SEED=true in .env
        if ((bool) env('IMPORT_ESHOP_SQL_SEED', false)) {
            $this->call(EshopSqlSeeder::class);
        }
    }
} 
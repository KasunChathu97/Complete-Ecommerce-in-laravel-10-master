<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
	public function up(): void
	{
		Schema::table('users', function (Blueprint $table) {
			if (!Schema::hasColumn('users', 'phone')) {
				// Keep this flexible: some deployments require phone NOT NULL.
				$table->string('phone', 50)->nullable()->default('')->after('email');
			}
		});
	}

	public function down(): void
	{
		// Intentionally left minimal to avoid unsafe drops in shared DBs.
	}
};

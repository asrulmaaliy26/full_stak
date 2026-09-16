<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $tables = ['news', 'projects', 'journals', 'facilities', 'messages'];

        foreach ($tables as $tableName) {
            if (Schema::hasTable($tableName)) {
                Schema::table($tableName, function (Blueprint $table) use ($tableName) {
                    if (!Schema::hasColumn($tableName, 'fakultas')) {
                        $table->string('fakultas')->nullable()->after('jenjang');
                    }
                    if (!Schema::hasColumn($tableName, 'jurusan')) {
                        $table->string('jurusan')->nullable()->after('fakultas');
                    }
                });
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $tables = ['news', 'projects', 'journals', 'facilities', 'messages'];

        foreach ($tables as $tableName) {
            if (Schema::hasTable($tableName)) {
                Schema::table($tableName, function (Blueprint $table) use ($tableName) {
                    if (Schema::hasColumn($tableName, 'jurusan')) {
                        $table->dropColumn('jurusan');
                    }
                    if (Schema::hasColumn($tableName, 'fakultas')) {
                        $table->dropColumn('fakultas');
                    }
                });
            }
        }
    }
};

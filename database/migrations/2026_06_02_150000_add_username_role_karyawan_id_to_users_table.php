<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (! Schema::hasColumn('users', 'username')) {
                $table->string('username')->unique()->after('email');
            }
            if (! Schema::hasColumn('users', 'role')) {
                $table->string('role')->default('karyawan')->after('username');
            }
            if (! Schema::hasColumn('users', 'karyawan_id')) {
                $table->foreignId('karyawan_id')->nullable()->constrained('karyawans')->nullOnDelete()->after('role');
            }
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'karyawan_id')) {
                $table->dropForeign(['karyawan_id']);
                $table->dropColumn('karyawan_id');
            }
            if (Schema::hasColumn('users', 'role')) {
                $table->dropColumn('role');
            }
            if (Schema::hasColumn('users', 'username')) {
                $table->dropColumn('username');
            }
        });
    }
};

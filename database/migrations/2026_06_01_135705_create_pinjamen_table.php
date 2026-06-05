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
        Schema::create('pinjamans', function (Blueprint $table) {
    $table->id();
    $table->foreignId('karyawan_id')->constrained('karyawans')->onDelete('cascade');
    $table->decimal('nominal', 15, 2);
    $table->integer('tenor');
    $table->text('alasan');
    $table->enum('status', ['Menunggu', 'Disetujui', 'Ditolak'])->default('Menunggu');
    $table->text('catatan_admin')->nullable();
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pinjamen');
    }
};

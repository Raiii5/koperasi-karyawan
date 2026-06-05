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
        Schema::create('angsurans', function (Blueprint $table) {
    $table->id();
    $table->foreignId('pinjaman_id')->constrained('pinjamans')->onDelete('cascade');
    $table->decimal('nominal_bayar', 15, 2);
    $table->date('tanggal_bayar');
    $table->text('keterangan')->nullable();
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('angsurans');
    }
};

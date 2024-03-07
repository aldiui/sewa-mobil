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
        Schema::create('pengembalians', function (Blueprint $table) {
            $table->id();
            $table->string('kode_pengembalian')->unique();
            $table->unsignedBigInteger('peminjam_id');
            $table->unsignedBigInteger('peminjaman_id');
            $table->integer('jumlah_hari');
            $table->integer('jumlah_denda_hari')->default(0);
            $table->integer('biaya_sewa');
            $table->integer('denda_sewa')->default(0);
            $table->timestamps();

            $table->foreign('peminjam_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('peminjaman_id')->references('id')->on('peminjamans')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengembalians');
    }
};

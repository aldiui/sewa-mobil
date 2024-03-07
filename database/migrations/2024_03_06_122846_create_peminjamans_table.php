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
        Schema::create('peminjamans', function (Blueprint $table) {
            $table->id();
            $table->string('kode_peminjaman')->unique();
            $table->unsignedBigInteger('peminjam_id');
            $table->unsignedBigInteger('mobil_id');
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->date('tanggal_pengembalian')->nullable();
            $table->enum('status', ['1', '0'])->default('0');
            $table->timestamps();

            $table->foreign('peminjam_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('mobil_id')->references('id')->on('mobils')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peminjamans');
    }
};
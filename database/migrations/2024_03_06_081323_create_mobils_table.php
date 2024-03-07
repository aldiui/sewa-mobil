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
        Schema::create('mobils', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('merek');
            $table->string('model');
            $table->string('tipe');
            $table->string('warna');
            $table->year('tahun_keluar');
            $table->string('bahan_bakar');
            $table->integer('kapasitas_penumpang');
            $table->string('nomor_plat')->unique();
            $table->integer('tarif_sewa_perhari');
            $table->integer('tarif_denda_perhari');
            $table->string('image');
            $table->enum('status', ['1', '0'])->default('1');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mobils');
    }
};
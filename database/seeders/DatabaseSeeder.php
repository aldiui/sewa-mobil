<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $users = [
            ['nama' => 'admin', 'alamat' => 'Tasikmalaya', 'nomor_telepon' => '11221122', 'nomor_sim' => '11221122', 'email' => 'admin@gmail.com', 'password' => bcrypt('11221122'), 'image' => null],
            ['nama' => 'user', 'alamat' => 'Bandung', 'nomor_telepon' => '22112211', 'nomor_sim' => '22112211', 'email' => 'user@gmail.com', 'password' => bcrypt('11221122'), 'image' => null],
        ];

        DB::table('users')->insert($users);

        $mobils = [
            ['user_id' => '1', 'merek' => 'Honda', 'model' => 'BR-V', 'tipe' => 'SUV', 'warna' => 'Putih', 'tahun_keluar' => '2021', 'bahan_bakar' => 'Bensin', 'kapasitas_penumpang' => '6', 'nomor_plat' => 'Z KLO1 0', 'tarif_sewa_perhari' => '150000', 'tarif_denda_perhari' => '200000', 'image' => 'brv.jpg', 'status' => '1'],
            ['user_id' => '1', 'merek' => 'Honda', 'model' => 'WR-V', 'tipe' => 'SUV', 'warna' => 'Merah', 'tahun_keluar' => '2018', 'bahan_bakar' => 'Bensin', 'kapasitas_penumpang' => '6', 'nomor_plat' => 'I KLB9 0', 'tarif_sewa_perhari' => '120000', 'tarif_denda_perhari' => '150000', 'image' => 'wrv.jpg', 'status' => '1'],
            ['user_id' => '1', 'merek' => 'Toyota', 'model' => 'Innova', 'tipe' => 'SUV', 'warna' => 'Putih', 'tahun_keluar' => '2021', 'bahan_bakar' => 'Bensin', 'kapasitas_penumpang' => '6', 'nomor_plat' => 'K JIO0 1', 'tarif_sewa_perhari' => '200000', 'tarif_denda_perhari' => '225000', 'image' => 'innova.jpg', 'status' => '1'],
        ];

        DB::table('mobils')->insert($mobils);

        $peminjamans = [
            ['kode_peminjaman' => 'PJM_65EAD65482980', 'peminjam_id' => '2', 'mobil_id' => '1', 'tanggal_mulai' => '2024-03-01', 'tanggal_selesai' => '2024-03-08', 'tanggal_pengembalian' => null, 'status' => '0', 'created_at' => now()],
        ];

        DB::table('peminjamans')->insert($peminjamans);
    }
}
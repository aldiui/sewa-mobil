<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

## Laravel Sewa Mobil

Proyek ini merupakan study kasus mengenai rental mobil yang mana setiap user antar 1 sama lain dapat melakukan rental mobil yang tersedia. yang mana dapat Mengelola Profil, Mobil, Sewa dan Mengembalikan Mobil serta laporan hasil penyewaan dengan menggunakan Laravel, Ajax, Bootstrap.

## Quick Setup

Berikut adalah langkah-langkah instalasi dalam Bahasa Indonesia:

-   Klon Repositori: `https://github.com/aldiui/sewa-mobil.git`
-   Masuk ke direktori baru yang telah dibuat `/sewa-mobil`
-   Jalankan perintah `composer install`
-   Salin file `.env.example` menjadi `.env` dengan menjalankan perintah `cp .env.example .env` dapat mengubah nama database menjadi db_sewa_mobil
-   Buat kunci aplikasi dengan perintah `php artisan key:generate`
-   Jalankan migrasi database beserta seeder dengan perintah `php artisan migrate --seed`
-   Buat tautan penyimpanan dengan perintah `php artisan storage:link`
-   Jalankan server dengan perintah `php artisan serve`
-   Selesai

Dengan mengikuti langkah-langkah di atas, Anda akan berhasil menginstal dan menjalankan proyek "Sewa Mobil". disini ada contoh 2 user admin dan user 22 nya memiliki hak akses yang sama namun untuk user sudah melakukan penyewaan untuk menngecek dapat melakukan pengembalian bisa login user dan melakukan pengembalia mobil dan admin dapat melihat laporan

#### Pengguna

-   Email: admin@gmail.com
-   Password: 11221122

-   Email: user@gmail.com
-   Password: 11221122

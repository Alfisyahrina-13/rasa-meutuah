# Rasa Meutuah
Kekayaan cita rasa dan budaya yang berharga (Aceh) - Laravel + MySQL.

## Cara pasang
1. Buat proyek Laravel (PHP 8.2+ dan Composer):
   composer create-project laravel/laravel rasa-meutuah
2. Salin seluruh isi folder ini ke dalam proyek tersebut (timpa file yang sama,
   yaitu routes/web.php dan database/seeders/DatabaseSeeder.php).
3. Buat database di MySQL / MariaDB:
   CREATE DATABASE rasa_meutuah CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
4. Edit .env:
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=rasa_meutuah
   DB_USERNAME=root
   DB_PASSWORD=
5. Jalankan:
   php artisan migrate --seed
   php artisan serve
6. Buka http://127.0.0.1:8000

## Menambah foto
Letakkan file di public/images lalu isi kolom `gambar` (misalnya mie-aceh.jpg)
pada tabel kuliners atau budayas. Tanpa foto, situs memakai emoji.

## Struktur data
- kuliners: nama, slug, jenis, daerah, ringkasan, deskripsi, bahan, emoji, gambar, unggulan
- budayas : nama, slug, kategori, ringkasan, deskripsi, emoji, gambar, unggulan
- pesans  : nama, email, pesan (dari formulir kontak)

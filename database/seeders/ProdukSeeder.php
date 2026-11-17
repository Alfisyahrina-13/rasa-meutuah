<?php

namespace Database\Seeders;

use App\Models\Produk;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProdukSeeder extends Seeder
{
    public function run(): void
    {
        // CATATAN: perajin, lokasi, dan harga di bawah ini adalah DATA CONTOH. Ganti dengan data asli Anda.
        $data = [
            ['Kopi Arabika Gayo', 'Koperasi Tani Gayo Lestari', 'Takengon', '250 g biji sangrai', 85000, '☕', true,
             'Arabika dari kebun dataran tinggi Gayo, disangrai medium agar rasanya seimbang dan aromanya bersih.',
             ['Arabika dataran tinggi', 'Sangrai medium', 'Kemasan kedap udara']],
            ['Asam Sunti', 'Dapur Mak Ti', 'Pidie', '250 g', 28000, '🍋', false,
             'Belimbing wuluh yang dijemur dan digarami, bumbu penting untuk gulai dan eungkot keumamah.',
             ['Dijemur alami', 'Rasa asam segar', 'Cocok untuk gulai dan sayur']],
            ['Timphan Isi Srikaya', 'Rumoh Kue Cut Meurah', 'Banda Aceh', 'Isi 10 buah', 45000, '🍃', true,
             'Kue ketan berbungkus daun pisang dengan isi srikaya yang manis dan legit.',
             ['Dibuat segar', 'Dibungkus daun pisang', 'Cocok untuk hantaran']],
            ['Emping Melinjo', 'Kelompok Perajin Beureunuen', 'Pidie', '500 g', 60000, '🥜', true,
             'Emping melinjo tipis yang ditempa satu per satu, renyah dan gurih saat digoreng.',
             ['Melinjo pilihan', 'Ditempa manual', 'Tanpa pengawet']],
            ['Bumbu Mie Aceh', 'Dapur Bungong', 'Banda Aceh', '200 g bumbu siap masak', 30000, '🌶️', false,
             'Bumbu kari pekat siap tumis untuk membuat mie Aceh goreng, tumis, atau kuah di rumah.',
             ['Resep rumahan', 'Siap masak', 'Pedas sedang']],
            ['Keukarah', 'Rumoh Kue Cut Meurah', 'Banda Aceh', 'Isi 12 buah', 55000, '🕸️', false,
             'Kue jaring dari adonan beras yang digoreng renyah dan dibalut gula karamel.',
             ['Renyah tahan lama', 'Dikemas kotak', 'Cocok untuk oleh-oleh']],
        ];

        foreach ($data as [$nama, $perajin, $lokasi, $ukuran, $harga, $emoji, $unggulan, $deskripsi, $fitur]) {
            Produk::updateOrCreate(['slug' => Str::slug($nama)], [
                'nama' => $nama, 'perajin' => $perajin, 'lokasi' => $lokasi, 'ukuran' => $ukuran,
                'harga' => $harga, 'emoji' => $emoji, 'unggulan' => $unggulan,
                'deskripsi' => $deskripsi, 'fitur' => implode("\n", $fitur),
            ]);
        }
    }
}

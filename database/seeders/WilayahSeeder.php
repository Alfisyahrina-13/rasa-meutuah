<?php

namespace Database\Seeders;

use App\Models\Wilayah;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class WilayahSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['Banda Aceh', 'Kota Serambi Mekkah', 'Mie Aceh dan Kopi Sanger', '🕌',
             'Ibu kota provinsi yang menjadi pusat sejarah, pemerintahan, dan warung kopi paling ramai di Aceh.',
             ['Masjid Raya Baiturrahman', 'Museum Tsunami Aceh', 'Pantai Ulee Lheue', 'Kapal PLTD Apung']],
            ['Aceh Besar', 'Pesisir dan Perbukitan', 'Ayam Tangkap dan Kuah Pliek U', '🏖️',
             'Wilayah yang mengelilingi Banda Aceh, dengan pantai berpasir putih dan dapur-dapur penjaga resep gulai.',
             ['Pantai Lampuuk', 'Benteng Indra Patra', 'Pantai Lhoknga']],
            ['Pidie', 'Negeri Perajin', 'Mie Caluk dan Emping Melinjo', '🥜',
             'Daerah dengan perajin emping melinjo dan kuliner jalur lintas yang selalu ramai pelancong.',
             ['Kota Sigli', 'Pasar Beureunuen', 'Tangse']],
            ['Bireuen', 'Kota Juang', 'Sate Matang', '🍢',
             'Tempat sate matang lahir dan menjadi kebanggaan warga, dengan bumbu kacang yang pekat.',
             ['Kota Juang Bireuen', 'Matang Geulumpang Dua']],
            ['Aceh Tengah', 'Dataran Tinggi Gayo', 'Kopi Gayo dan Ikan Depik', '⛰️',
             'Wilayah berhawa sejuk di sekitar Danau Laut Tawar, rumah bagi kopi arabika dan Tari Saman.',
             ['Danau Laut Tawar', 'Pasar Takengon', 'Kebun Kopi Gayo']],
            ['Sabang', 'Titik Nol Indonesia', 'Sate Gurita dan Ikan Bakar', '🏝️',
             'Pulau di ujung barat Indonesia dengan laut jernih dan hidangan laut yang segar.',
             ['Tugu Nol Kilometer', 'Pantai Iboih', 'Pulau Rubiah']],
        ];

        foreach ($data as $i => [$nama, $julukan, $sajian, $emoji, $deskripsi, $tempat]) {
            Wilayah::updateOrCreate(['slug' => Str::slug($nama)], [
                'nama' => $nama, 'julukan' => $julukan, 'sajian' => $sajian, 'emoji' => $emoji,
                'deskripsi' => $deskripsi, 'tempat' => implode("\n", $tempat), 'urutan' => $i,
            ]);
        }
    }
}

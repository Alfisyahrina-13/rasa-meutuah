<?php

return [
    'status_pesanan' => ['baru', 'diproses', 'dikirim', 'selesai', 'batal'],

    'resources' => [

        'beranda' => [
            'model' => \App\Models\Beranda::class, 'label' => 'Beranda', 'urut' => 'id', 'tunggal' => true,
            'kolom' => ['nama' => 'Judul'],
            'fields' => [
                ['name' => 'nama', 'label' => 'Judul situs', 'type' => 'text', 'required' => true, 'max' => 80],
                ['name' => 'tagline', 'label' => 'Tagline', 'type' => 'text', 'required' => true],
                ['name' => 'deskripsi', 'label' => 'Paragraf pembuka', 'type' => 'textarea', 'required' => true],
                ['name' => 'filosofi_judul', 'label' => 'Judul bagian "Mengapa meutuah"', 'type' => 'text', 'required' => true],
                ['name' => 'filosofi_isi', 'label' => 'Isi bagian "Mengapa meutuah"', 'type' => 'textarea', 'required' => true, 'hint' => 'Satu paragraf per baris.'],
                ['name' => 'cta_judul', 'label' => 'Judul ajakan di bawah', 'type' => 'text', 'required' => true],
                ['name' => 'cta_teks', 'label' => 'Teks ajakan di bawah', 'type' => 'textarea', 'required' => true],
                ['name' => 'gambar', 'label' => 'Foto utama beranda', 'type' => 'image'],
            ],
        ],

        'kuliner' => [
            'model' => \App\Models\Kuliner::class, 'label' => 'Kuliner', 'urut' => 'nama', 'rute_publik' => 'kuliner.show',
            'kolom' => ['nama' => 'Nama', 'jenis' => 'Jenis', 'daerah' => 'Daerah', 'unggulan' => 'Unggulan'],
            'fields' => [
                ['name' => 'nama', 'label' => 'Nama', 'type' => 'text', 'required' => true, 'max' => 120],
                ['name' => 'jenis', 'label' => 'Jenis', 'type' => 'combo', 'required' => true, 'options' => ['Makanan', 'Minuman', 'Kudapan']],
                ['name' => 'daerah', 'label' => 'Daerah asal', 'type' => 'text', 'required' => true, 'max' => 150],
                ['name' => 'ringkasan', 'label' => 'Ringkasan (1 kalimat)', 'type' => 'text', 'required' => true],
                ['name' => 'deskripsi', 'label' => 'Deskripsi', 'type' => 'textarea', 'required' => true],
                ['name' => 'bahan', 'label' => 'Bahan utama', 'type' => 'textarea', 'hint' => 'Pisahkan dengan koma. Contoh: cabai, bawang merah, kunyit'],
                ['name' => 'waktu', 'label' => 'Waktu memasak', 'type' => 'text', 'max' => 50, 'hint' => 'Contoh: 45 menit'],
                ['name' => 'porsi', 'label' => 'Hasil', 'type' => 'text', 'max' => 50, 'hint' => 'Contoh: 4 porsi'],
                ['name' => 'langkah', 'label' => 'Langkah memasak', 'type' => 'textarea', 'hint' => 'Satu langkah per baris.'],
                ['name' => 'gambar', 'label' => 'Foto', 'type' => 'image'],
                ['name' => 'unggulan', 'label' => 'Tampilkan di beranda', 'type' => 'checkbox'],
            ],
        ],

        'budaya' => [
            'model' => \App\Models\Budaya::class, 'label' => 'Budaya', 'urut' => 'nama', 'rute_publik' => 'budaya.show',
            'kolom' => ['nama' => 'Nama', 'kategori' => 'Kategori', 'menit' => 'Menit baca', 'unggulan' => 'Unggulan'],
            'fields' => [
                ['name' => 'nama', 'label' => 'Nama', 'type' => 'text', 'required' => true, 'max' => 120],
                ['name' => 'kategori', 'label' => 'Kategori', 'type' => 'combo', 'required' => true, 'options' => ['Tari', 'Musik', 'Arsitektur', 'Tradisi', 'Pusaka']],
                ['name' => 'ringkasan', 'label' => 'Ringkasan (1 kalimat)', 'type' => 'text', 'required' => true],
                ['name' => 'deskripsi', 'label' => 'Isi tulisan', 'type' => 'textarea', 'required' => true, 'hint' => 'Satu paragraf per baris.'],
                ['name' => 'menit', 'label' => 'Menit baca', 'type' => 'number', 'default' => 4],
                ['name' => 'gambar', 'label' => 'Foto', 'type' => 'image'],
                ['name' => 'unggulan', 'label' => 'Tampilkan di beranda', 'type' => 'checkbox'],
            ],
        ],

        'wilayah' => [
            'model' => \App\Models\Wilayah::class, 'label' => 'Wilayah', 'urut' => 'urutan',
            'kolom' => ['nama' => 'Nama', 'julukan' => 'Julukan', 'sajian' => 'Sajian khas', 'urutan' => 'Urutan'],
            'fields' => [
                ['name' => 'nama', 'label' => 'Nama wilayah', 'type' => 'text', 'required' => true, 'max' => 120],
                ['name' => 'julukan', 'label' => 'Julukan', 'type' => 'text', 'required' => true],
                ['name' => 'sajian', 'label' => 'Sajian khas', 'type' => 'text', 'required' => true],
                ['name' => 'deskripsi', 'label' => 'Deskripsi', 'type' => 'textarea', 'required' => true],
                ['name' => 'tempat', 'label' => 'Tempat yang layak dikunjungi', 'type' => 'textarea', 'required' => true, 'hint' => 'Satu tempat per baris.'],
                ['name' => 'urutan', 'label' => 'Urutan tab', 'type' => 'number', 'default' => 0],
                ['name' => 'gambar', 'label' => 'Foto', 'type' => 'image'],
            ],
        ],

        'produk' => [
            'model' => \App\Models\Produk::class, 'label' => 'Oleh-oleh', 'urut' => 'nama',
            'kolom' => ['nama' => 'Nama', 'perajin' => 'Perajin', 'harga' => 'Harga', 'unggulan' => 'Unggulan'],
            'fields' => [
                ['name' => 'nama', 'label' => 'Nama produk', 'type' => 'text', 'required' => true, 'max' => 120],
                ['name' => 'perajin', 'label' => 'Perajin / toko', 'type' => 'text', 'required' => true],
                ['name' => 'lokasi', 'label' => 'Lokasi', 'type' => 'text', 'required' => true],
                ['name' => 'deskripsi', 'label' => 'Deskripsi', 'type' => 'textarea', 'required' => true],
                ['name' => 'fitur', 'label' => 'Keunggulan', 'type' => 'textarea', 'hint' => 'Satu poin per baris.'],
                ['name' => 'harga', 'label' => 'Harga (Rupiah)', 'type' => 'number', 'required' => true],
                ['name' => 'ukuran', 'label' => 'Ukuran / isi', 'type' => 'text', 'required' => true, 'max' => 60, 'hint' => 'Contoh: 250 g'],
                ['name' => 'gambar', 'label' => 'Foto', 'type' => 'image'],
                ['name' => 'unggulan', 'label' => 'Tampilkan di beranda', 'type' => 'checkbox'],
            ],
        ],
    ],
];

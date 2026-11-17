<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Beranda extends Model
{
    protected $guarded = [];

    /** Baris tunggal berisi teks beranda. Dibuat otomatis kalau belum ada. */
    public static function ambil(): self
    {
        return static::first() ?? static::create([
            'nama'           => 'Rasa Meutuah',
            'tagline'        => 'Kekayaan cita rasa dan budaya yang berharga',
            'deskripsi'      => 'Meutuah, dalam bahasa Aceh, berarti bertuah atau berharga. Kami menuliskan resep, mengenalkan wilayah, dan menghubungkan Anda langsung dengan perajin Aceh.',
            'filosofi_judul' => 'Mengapa Aceh disebut tanah yang meutuah?',
            'filosofi_isi'   => "Di Aceh, segelas kopi, sepiring gulai, dan sebuah tarian bukan sekadar kebiasaan. Semuanya adalah cara memuliakan tamu, bersyukur atas hasil bumi, dan menjaga hubungan antarkeluarga.\nItulah yang kami sebut meutuah: warisan yang membawa berkah karena terus dirawat dari generasi ke generasi.",
            'cta_judul'      => 'Punya resep keluarga atau kisah dari kampung?',
            'cta_teks'       => 'Kirimkan kepada kami. Setiap resep yang ditulis hari ini adalah warisan bagi dapur esok hari.',
        ]);
    }

    /** Foto beranda: kolom gambar, lalu public/images/hero.(jpg|png|webp|svg). */
    public function getFotoUrlAttribute(): ?string
    {
        $kandidat = [];
        if ($this->gambar) {
            $kandidat[] = $this->gambar;
        }
        foreach (['jpg', 'jpeg', 'png', 'webp', 'svg'] as $ext) {
            $kandidat[] = 'hero.'.$ext;
        }
        foreach ($kandidat as $f) {
            if (is_file(public_path('images/'.$f))) {
                return asset('images/'.$f);
            }
        }

        return null;
    }
}

<?php

namespace App\Models\Concerns;

trait PunyaFoto
{
    /**
     * Cari foto di public/images:
     * 1) nama file di kolom `gambar`, atau
     * 2) {slug}.jpg / .jpeg / .png / .webp / .svg  (contoh: mie-aceh.jpg)
     *    Foto asli selalu diutamakan daripada ilustrasi .svg bawaan.
     */
    public function getFotoUrlAttribute(): ?string
    {
        $kandidat = [];

        if ($gambar = $this->getAttribute('gambar')) {
            $kandidat[] = $gambar;
        }
        foreach (['jpg', 'jpeg', 'png', 'webp', 'svg'] as $ext) {
            $kandidat[] = $this->slug.'.'.$ext;
        }

        foreach ($kandidat as $file) {
            if (is_file(public_path('images/'.$file))) {
                return asset('images/'.$file);
            }
        }

        return null;
    }
}

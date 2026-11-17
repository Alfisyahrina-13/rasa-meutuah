<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use \App\Models\Concerns\PunyaFoto;

    protected $guarded = [];

    public function daftarFitur(): array
    {
        return array_values(array_filter(array_map('trim', explode("\n", (string) $this->fitur))));
    }
}

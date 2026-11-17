<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wilayah extends Model
{
    use \App\Models\Concerns\PunyaFoto;

    protected $guarded = [];

    public function daftarTempat(): array
    {
        return array_values(array_filter(array_map('trim', explode("\n", $this->tempat))));
    }
}

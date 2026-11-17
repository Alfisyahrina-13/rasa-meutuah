<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kuliner extends Model
{
    use \App\Models\Concerns\PunyaFoto;

    protected $guarded = [];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}

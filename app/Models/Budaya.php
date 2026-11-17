<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Budaya extends Model
{
    use \App\Models\Concerns\PunyaFoto;

    protected $guarded = [];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}

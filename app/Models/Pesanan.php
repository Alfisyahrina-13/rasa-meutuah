<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    protected $guarded = [];

    protected $casts = ['items' => 'array'];
}

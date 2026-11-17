<?php

namespace App\Http\Controllers;

use App\Models\Wilayah;

class WilayahController extends Controller
{
    public function index()
    {
        return view('wilayah.index', ['wilayahs' => Wilayah::orderBy('urutan')->get()]);
    }
}

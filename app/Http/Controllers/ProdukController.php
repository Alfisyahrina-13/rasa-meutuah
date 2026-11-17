<?php

namespace App\Http\Controllers;

use App\Models\Produk;

class ProdukController extends Controller
{
    public function index()
    {
        return view('oleh-oleh.index', ['produks' => Produk::orderBy('nama')->get()]);
    }
}

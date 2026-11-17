<?php

namespace App\Http\Controllers;

use App\Models\Beranda;
use App\Models\Budaya;
use App\Models\Kuliner;
use App\Models\Produk;
use App\Models\Wilayah;

class HomeController extends Controller
{
    public function index()
    {
        return view('home', [
            'beranda'  => Beranda::ambil(),
            'menu'     => Kuliner::orderBy('nama')->get(['nama', 'slug']),
            'kuliners' => Kuliner::where('unggulan', true)->take(3)->get(),
            'wilayahs' => Wilayah::orderBy('urutan')->get(),
            'produks'  => Produk::where('unggulan', true)->take(3)->get(),
            'budayas'  => Budaya::where('unggulan', true)->take(3)->get(),
        ]);
    }
}

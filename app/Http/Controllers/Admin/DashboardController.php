<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Budaya;
use App\Models\Kuliner;
use App\Models\Pesan;
use App\Models\Pesanan;
use App\Models\Produk;
use App\Models\Wilayah;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'stat' => [
                ['Kuliner', Kuliner::count(), 'admin.crud.index', 'kuliner'],
                ['Budaya', Budaya::count(), 'admin.crud.index', 'budaya'],
                ['Wilayah', Wilayah::count(), 'admin.crud.index', 'wilayah'],
                ['Oleh-oleh', Produk::count(), 'admin.crud.index', 'produk'],
            ],
            'pesananBaru'  => Pesanan::where('status', 'baru')->count(),
            'pesanBaru'    => Pesan::where('dibaca', false)->count(),
            'terbaru'      => Pesanan::latest()->take(6)->get(),
        ]);
    }
}

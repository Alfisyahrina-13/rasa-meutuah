<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pesan;

class PesanController extends Controller
{
    public function index()
    {
        return view('admin.pesan.index', ['items' => Pesan::orderBy('dibaca')->latest()->paginate(20)]);
    }

    public function update(Pesan $pesan)
    {
        $pesan->dibaca = ! $pesan->dibaca;
        $pesan->save();

        return back();
    }

    public function destroy(Pesan $pesan)
    {
        $pesan->delete();

        return back()->with('ok', 'Pesan dihapus.');
    }
}

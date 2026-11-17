<?php

namespace App\Http\Controllers;

use App\Models\Pesan;
use Illuminate\Http\Request;

class KontakController extends Controller
{
    public function index()
    {
        return view('kontak');
    }

    public function kirim(Request $request)
    {
        $data = $request->validate([
            'nama'  => 'required|string|max:100',
            'email' => 'required|email|max:150',
            'pesan' => 'required|string|min:10|max:2000',
        ], [
            'nama.required'  => 'Nama wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email'    => 'Format email belum benar.',
            'pesan.required' => 'Pesan wajib diisi.',
            'pesan.min'      => 'Pesan minimal 10 karakter.',
        ]);

        Pesan::create($data);

        return redirect()->route('kontak')->with('sukses', 'Pesan terkirim. Teurimong geunaseh!');
    }
}

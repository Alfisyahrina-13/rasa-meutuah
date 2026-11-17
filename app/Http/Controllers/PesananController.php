<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PesananController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'nama'         => 'required|string|max:100',
            'wa'           => ['required', 'regex:/^[0-9+\s-]{9,20}$/'],
            'kota'         => 'required|string|max:100',
            'alamat'       => 'required|string|max:500',
            'catatan'      => 'nullable|string|max:500',
            'items'        => 'required|array|min:1|max:30',
            'items.*.id'   => 'required|integer',
            'items.*.qty'  => 'required|integer|min:1|max:99',
        ], [
            'nama.required'   => 'Nama penerima wajib diisi.',
            'wa.required'     => 'Nomor WhatsApp wajib diisi.',
            'wa.regex'        => 'Nomor WhatsApp belum benar.',
            'kota.required'   => 'Kota atau kabupaten tujuan wajib diisi.',
            'alamat.required' => 'Alamat lengkap wajib diisi.',
            'items.required'  => 'Keranjang masih kosong.',
        ]);

        // Harga selalu dihitung ulang dari database, bukan dari browser.
        $produk = Produk::whereIn('id', collect($data['items'])->pluck('id'))->get()->keyBy('id');

        $baris = [];
        $total = 0;
        foreach ($data['items'] as $item) {
            $p = $produk[$item['id']] ?? null;
            if (! $p) {
                continue;
            }
            $sub = $p->harga * $item['qty'];
            $total += $sub;
            $baris[] = [
                'id' => $p->id, 'nama' => $p->nama, 'ukuran' => $p->ukuran,
                'harga' => $p->harga, 'qty' => $item['qty'], 'subtotal' => $sub,
            ];
        }

        if (! $baris) {
            return response()->json(['message' => 'Produk di keranjang tidak ditemukan.'], 422);
        }

        $kode = 'RM-'.strtoupper(Str::random(6));

        Pesanan::create([
            'kode' => $kode, 'nama' => $data['nama'], 'wa' => $data['wa'], 'kota' => $data['kota'],
            'alamat' => $data['alamat'], 'catatan' => $data['catatan'] ?? null,
            'items' => $baris, 'total' => $total,
        ]);

        $teks = "Halo Rasa Meutuah, saya ingin konfirmasi pesanan {$kode} atas nama {$data['nama']} "
              .'(total barang Rp '.number_format($total, 0, ',', '.').'). Mohon info ongkos kirim dan cara pembayaran.';

        return response()->json([
            'kode'  => $kode,
            'total' => $total,
            'wa'    => 'https://wa.me/'.config('rasa.wa').'?text='.rawurlencode($teks),
        ]);
    }
}

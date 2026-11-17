<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pesanan;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PesananController extends Controller
{
    public function index(Request $request)
    {
        $items = Pesanan::query()
            ->when($request->status, fn ($q, $v) => $q->where('status', $v))
            ->latest()
            ->paginate(20)
            ->withQueryString();

        return view('admin.pesanan.index', ['items' => $items, 'statusList' => config('admin.status_pesanan')]);
    }

    public function show(Pesanan $pesanan)
    {
        $nomor = preg_replace('/\D/', '', $pesanan->wa);
        if (str_starts_with($nomor, '0')) {
            $nomor = '62'.substr($nomor, 1);
        }

        return view('admin.pesanan.show', [
            'p' => $pesanan,
            'statusList' => config('admin.status_pesanan'),
            'waUrl' => 'https://wa.me/'.$nomor.'?text='.rawurlencode("Halo {$pesanan->nama}, kami dari Rasa Meutuah mengonfirmasi pesanan {$pesanan->kode}."),
        ]);
    }

    public function update(Request $request, Pesanan $pesanan)
    {
        $data = $request->validate(['status' => ['required', Rule::in(config('admin.status_pesanan'))]]);
        $pesanan->update($data);

        return back()->with('ok', 'Status pesanan diperbarui.');
    }

    public function destroy(Pesanan $pesanan)
    {
        $pesanan->delete();

        return redirect()->route('admin.pesanan.index')->with('ok', 'Pesanan dihapus.');
    }
}

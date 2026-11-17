<?php

namespace App\Http\Controllers;

use App\Models\Kuliner;
use Illuminate\Http\Request;

class KulinerController extends Controller
{
    public function index(Request $request)
    {
        $items = Kuliner::query()
            ->when($request->q, fn ($q, $v) => $q->where(function ($w) use ($v) {
                $w->where('nama', 'like', "%{$v}%")->orWhere('ringkasan', 'like', "%{$v}%");
            }))
            ->when($request->jenis, fn ($q, $v) => $q->where('jenis', $v))
            ->orderBy('nama')
            ->paginate(9)
            ->withQueryString();

        return view('kuliner.index', [
            'items' => $items,
            'jenisList' => Kuliner::select('jenis')->distinct()->orderBy('jenis')->pluck('jenis'),
        ]);
    }

    public function show(Kuliner $kuliner)
    {
        $lain = Kuliner::where('id', '!=', $kuliner->id)->inRandomOrder()->take(3)->get();

        return view('kuliner.show', ['item' => $kuliner, 'lain' => $lain]);
    }
}

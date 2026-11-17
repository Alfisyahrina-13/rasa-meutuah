<?php

namespace App\Http\Controllers;

use App\Models\Budaya;
use Illuminate\Http\Request;

class BudayaController extends Controller
{
    public function index(Request $request)
    {
        $items = Budaya::query()
            ->when($request->kategori, fn ($q, $v) => $q->where('kategori', $v))
            ->orderBy('nama')
            ->paginate(9)
            ->withQueryString();

        return view('budaya.index', [
            'items' => $items,
            'kategoriList' => Budaya::select('kategori')->distinct()->orderBy('kategori')->pluck('kategori'),
        ]);
    }

    public function show(Budaya $budaya)
    {
        $lain = Budaya::where('id', '!=', $budaya->id)->inRandomOrder()->take(3)->get();

        return view('budaya.show', ['item' => $budaya, 'lain' => $lain]);
    }
}

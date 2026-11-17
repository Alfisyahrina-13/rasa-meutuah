@extends('layouts.app')
@section('title', 'Kuliner')

@section('content')
<section class="page-head"><div class="wrap">
    <h1>Kuliner Aceh</h1>
    <p>Dari mie berbumbu kari hingga kopi dataran tinggi Gayo.</p>
</div></section>

<section class="wrap block">
    <form class="filter" method="GET" action="{{ route('kuliner.index') }}">
        <label class="sr" for="q">Cari kuliner</label>
        <input id="q" type="search" name="q" value="{{ request('q') }}" placeholder="Cari nama atau deskripsi">
        <label class="sr" for="jenis">Jenis</label>
        <select id="jenis" name="jenis">
            <option value="">Semua jenis</option>
            @foreach ($jenisList as $j)
                <option value="{{ $j }}" @selected(request('jenis') === $j)>{{ $j }}</option>
            @endforeach
        </select>
        <button class="btn cabai" type="submit">Cari</button>
    </form>

    @if ($items->isEmpty())
        <p class="empty">Tidak ada kuliner yang cocok. Coba kata kunci lain atau <a href="{{ route('kuliner.index') }}">tampilkan semua</a>.</p>
    @else
        <div class="grid">
            @foreach ($items as $item)
                @include('partials.card', ['item' => $item, 'rute' => 'kuliner.show', 'label' => $item->jenis, 'fav' => true])
            @endforeach
        </div>
        {{ $items->links('pagination::default') }}
    @endif
</section>
@endsection

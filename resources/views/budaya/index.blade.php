@extends('layouts.app')
@section('title', 'Budaya')

@section('content')
<section class="page-head"><div class="wrap">
    <h1>Budaya Aceh</h1>
    <p>Tari, musik, rumah adat, dan tradisi yang diwariskan lintas generasi.</p>
</div></section>

<section class="wrap block">
    <nav class="pills" aria-label="Kategori budaya">
        <a href="{{ route('budaya.index') }}" @class(['on' => !request('kategori')])>Semua</a>
        @foreach ($kategoriList as $k)
            <a href="{{ route('budaya.index', ['kategori' => $k]) }}" @class(['on' => request('kategori') === $k])>{{ $k }}</a>
        @endforeach
    </nav>

    @if ($items->isEmpty())
        <p class="empty">Belum ada budaya pada kategori ini.</p>
    @else
        <div class="grid">
            @foreach ($items as $item)
                @include('partials.card', ['item' => $item, 'rute' => 'budaya.show', 'label' => $item->kategori])
            @endforeach
        </div>
        {{ $items->links('pagination::default') }}
    @endif
</section>
@endsection

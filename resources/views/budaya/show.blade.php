@extends('layouts.app')
@section('title', $item->nama)

@section('content')
<article class="wrap detail">
    <a class="back" href="{{ route('budaya.index') }}">Kembali ke budaya</a>
    <div class="detail-grid">
        <div class="detail-media">@include('partials.media', ['item' => $item])</div>
        <div>
            <span class="tag">{{ $item->kategori }}</span>
            <h1>{{ $item->nama }}</h1>
            <p class="meta">{{ $item->menit }} menit baca</p>
            @foreach (array_filter(explode("\n", $item->deskripsi)) as $para)
                <p>{{ $para }}</p>
            @endforeach
        </div>
    </div>
</article>

<section class="wrap block">
    <h2>Budaya lainnya</h2>
    <div class="grid">
        @foreach ($lain as $l)
            @include('partials.card', ['item' => $l, 'rute' => 'budaya.show', 'label' => $l->kategori])
        @endforeach
    </div>
</section>
@endsection

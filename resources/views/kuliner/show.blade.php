@extends('layouts.app')
@section('title', $item->nama)

@section('content')
<article class="wrap detail">
    <a class="back" href="{{ route('kuliner.index') }}">Kembali ke kuliner</a>
    <div class="detail-grid">
        <div class="detail-media">@include('partials.media', ['item' => $item])</div>
        <div>
            <span class="tag">{{ $item->jenis }}</span>
            <h1>{{ $item->nama }}</h1>
            <p class="meta">Asal: {{ $item->daerah }}</p>
            <p>{{ $item->deskripsi }}</p>

            <div class="facts">
                @if ($item->waktu)<div><small>Waktu</small><strong>{{ $item->waktu }}</strong></div>@endif
                @if ($item->porsi)<div><small>Hasil</small><strong>{{ $item->porsi }}</strong></div>@endif
            </div>

            <button type="button" class="btn ghost-dark savebtn" data-fav data-slug="{{ $item->slug }}" data-nama="{{ $item->nama }}"
                    data-url="{{ route('kuliner.show', $item) }}" aria-pressed="false">Simpan resep</button>

            @if ($item->bahan)
                <h2>Bahan utama</h2>
                <ul class="chips">
                    @foreach (explode(',', $item->bahan) as $b)<li>{{ trim($b) }}</li>@endforeach
                </ul>
            @endif

            @if ($item->langkah)
                <h2>Cara membuat</h2>
                <ol class="steps">
                    @foreach (array_filter(explode("\n", $item->langkah)) as $l)<li>{{ $l }}</li>@endforeach
                </ol>
            @endif
        </div>
    </div>
</article>

<section class="wrap block">
    <h2>Kuliner lainnya</h2>
    <div class="grid">
        @foreach ($lain as $l)
            @include('partials.card', ['item' => $l, 'rute' => 'kuliner.show', 'label' => $l->jenis, 'fav' => true])
        @endforeach
    </div>
</section>
@endsection

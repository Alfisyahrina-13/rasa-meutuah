@extends('layouts.app')
@section('title', 'Beranda')

@section('content')
<section class="hero">
    <div class="wrap hero-grid">
        <div class="hero-text">
            <h1>{!! preg_replace('/\s+/', '<br>', e($beranda->nama)) !!}</h1>
            <p class="lead">{{ $beranda->tagline }}</p>
            <p class="hero-note">{{ $beranda->deskripsi }}</p>
            <div class="actions">
                <a class="btn cabai" href="{{ route('kuliner.index') }}">Jelajahi kuliner</a>
                <a class="btn ghost" href="{{ route('oleh-oleh') }}">Pesan oleh-oleh</a>
                <a class="btn ghost" href="{{ route('budaya.index') }}">Baca hikayat</a>
            </div>
        </div>

        <div class="arch" aria-hidden="true">
            @if ($beranda->foto_url)
                <img src="{{ $beranda->foto_url }}" alt="">
            @else
                <span class="arch-main">RM</span>
                <span class="chip c1">Mie Aceh</span>
                <span class="chip c2">Tari Saman</span>
                <span class="chip c3">Rumoh Aceh</span>
            @endif
        </div>
    </div>
</section>

<div class="marquee" aria-label="Daftar kuliner">
    <div class="track">
        @foreach ([0, 1] as $dup)
            <div class="grp" @if($dup) aria-hidden="true" @endif>
                @foreach ($menu as $m)
                    <a href="{{ route('kuliner.show', $m->slug) }}" @if($dup) tabindex="-1" @endif>{{ $m->nama }}</a><i>✦</i>
                @endforeach
            </div>
        @endforeach
    </div>
</div>

<section class="sec filosofi">
    <div class="wrap two">
        <h2>{{ $beranda->filosofi_judul }}</h2>
        <div>
            @foreach (array_filter(explode("\n", $beranda->filosofi_isi)) as $para)
                <p>{{ $para }}</p>
            @endforeach
            <a class="more" href="{{ route('budaya.index') }}">Baca hikayat budaya</a>
        </div>
    </div>
</section>

<section class="sec soft">
    <div class="wrap">
        <div class="sec-head">
            <div>
                <h2>Pustaka rasa</h2>
                <p>Bahan, takaran, dan langkah memasak hidangan khas Aceh.</p>
            </div>
            <a class="more" href="{{ route('kuliner.index') }}">Lihat semua resep</a>
        </div>
        <div class="feature">
            @forelse ($kuliners as $k)
                @include('partials.card', ['item' => $k, 'rute' => 'kuliner.show', 'label' => $k->jenis, 'fav' => true])
            @empty
                <p class="empty">Belum ada data. Jalankan <code>php artisan migrate --seed</code>.</p>
            @endforelse
        </div>
    </div>
</section>

<section class="sec">
    <div class="wrap">
        <div class="sec-head">
            <div>
                <h2>Enam wilayah, enam cara memuliakan rasa</h2>
                <p>Dari pesisir sampai dataran tinggi, setiap wilayah punya satu sajian dan satu cerita.</p>
            </div>
            <a class="more" href="{{ route('wilayah') }}">Buka halaman wilayah</a>
        </div>
        @include('partials.wilayah', ['wilayahs' => $wilayahs])
    </div>
</section>

<section class="sec soft">
    <div class="wrap">
        <div class="sec-head">
            <div>
                <h2>Oleh-oleh dari perajin</h2>
                <p>Pesan langsung, lalu konfirmasi lewat WhatsApp.</p>
            </div>
            <a class="more" href="{{ route('oleh-oleh') }}">Lihat semua produk</a>
        </div>
        <div class="grid">
            @foreach ($produks as $p)
                @include('partials.produk', ['p' => $p])
            @endforeach
        </div>
    </div>
</section>

<section class="sec">
    <div class="wrap">
        <div class="sec-head">
            <div>
                <h2>Hikayat dan budaya</h2>
                <p>Catatan tentang tari, tradisi, rumah adat, dan pusaka Aceh.</p>
            </div>
            <a class="more" href="{{ route('budaya.index') }}">Lihat semua</a>
        </div>
        <ul class="rows">
            @foreach ($budayas as $b)
                <li>
                    <a href="{{ route('budaya.show', $b) }}">
                        <span class="row-thumb">@include('partials.media', ['item' => $b])</span>
                        <span class="row-text"><strong>{{ $b->nama }}</strong>{{ $b->ringkasan }}</span>
                        <span class="row-meta"><span>{{ $b->kategori }}</span><span>{{ $b->menit }} menit baca</span></span>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</section>

<section class="cta">
    <div class="wrap cta-in">
        <div>
            <h2>{{ $beranda->cta_judul }}</h2>
            <p>{{ $beranda->cta_teks }}</p>
        </div>
        <a class="btn cabai" href="{{ route('kontak') }}">Kirim resep atau kisah</a>
    </div>
</section>
@endsection

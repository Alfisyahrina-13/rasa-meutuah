@extends('layouts.app')
@section('title', 'Oleh-oleh')

@section('content')
<section class="page-head"><div class="wrap">
    <h1>Oleh-oleh dari perajin Aceh</h1>
    <p>Pilih produk, masukkan ke keranjang, lalu konfirmasi pesanan lewat WhatsApp.</p>
</div></section>
<section class="wrap block">
    @if ($produks->isEmpty())
        <p class="empty">Belum ada produk. Jalankan <code>php artisan db:seed</code>.</p>
    @else
        <div class="grid">
            @foreach ($produks as $p)
                @include('partials.produk', ['p' => $p])
            @endforeach
        </div>
    @endif
</section>
@endsection

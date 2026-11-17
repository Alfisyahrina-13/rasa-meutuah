<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Rasa Meutuah') | Rasa Meutuah</title>
    <meta name="description" content="Rasa Meutuah: kekayaan cita rasa dan budaya yang berharga dari Aceh. Resep, wilayah, oleh-oleh perajin, dan hikayat budaya.">
    <meta name="theme-color" content="#071318">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@500;600;700&family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/rasa.css') }}">
    <script src="{{ asset('js/rasa.js') }}" defer></script>
</head>
<body data-pesanan-url="{{ route('pesanan.store', [], false) }}">
<a class="skip" href="#konten">Lompat ke konten</a>

<header class="top">
    <div class="wrap bar">
        <a class="brand" href="{{ route('home') }}"><span class="mark" aria-hidden="true"></span>Rasa Meutuah</a>

        <button class="menu-btn" type="button" aria-expanded="false" aria-controls="nav">Menu</button>
        <nav id="nav" aria-label="Menu utama">
            <a href="{{ route('home') }}" @class(['on' => request()->routeIs('home')])>Beranda</a>
            <a href="{{ route('kuliner.index') }}" @class(['on' => request()->routeIs('kuliner.*')])>Kuliner</a>
            <a href="{{ route('wilayah') }}" @class(['on' => request()->routeIs('wilayah')])>Wilayah</a>
            <a href="{{ route('oleh-oleh') }}" @class(['on' => request()->routeIs('oleh-oleh')])>Oleh-oleh</a>
            <a href="{{ route('budaya.index') }}" @class(['on' => request()->routeIs('budaya.*')])>Budaya</a>
            <a href="{{ route('kontak') }}" @class(['on' => request()->routeIs('kontak')])>Kontak</a>
        </nav>

        <div class="tools">
            <button class="tool" type="button" data-open="fav" aria-label="Resep tersimpan">
                <span aria-hidden="true">♡</span><b data-fav-count hidden>0</b>
            </button>
            <button class="tool wide" type="button" data-open="cart" aria-label="Keranjang oleh-oleh">
                Keranjang<b data-cart-count hidden>0</b>
            </button>
        </div>
    </div>
</header>

<main id="konten">@yield('content')</main>

<footer class="foot">
    <div class="rebung" aria-hidden="true"></div>
    <div class="wrap foot-grid">
        <div>
            <p class="foot-title">Rasa Meutuah</p>
            <p>Kekayaan cita rasa dan budaya yang berharga dari Aceh. Kami menuliskan resep, mengenalkan wilayah, dan menghubungkan Anda dengan perajin lokal.</p>
        </div>
        <div>
            <h2>Jelajahi</h2>
            <ul>
                <li><a href="{{ route('kuliner.index') }}">Kuliner dan resep</a></li>
                <li><a href="{{ route('wilayah') }}">Wilayah Aceh</a></li>
                <li><a href="{{ route('oleh-oleh') }}">Oleh-oleh</a></li>
                <li><a href="{{ route('budaya.index') }}">Budaya dan hikayat</a></li>
            </ul>
        </div>
        <div>
            <h2>Hubungi kami</h2>
            <ul>
                <li><a href="https://wa.me/{{ config('rasa.wa') }}">WhatsApp</a></li>
                <li><a href="{{ route('kontak') }}">Formulir kontak</a></li>
            </ul>
        </div>
    </div>
    <p class="wrap small copy">&copy; {{ date('Y') }} Rasa Meutuah. Memuliakan tamu, merawat warisan rasa.</p>
</footer>

<div id="overlay" class="overlay" hidden></div>

{{-- Keranjang --}}
<aside id="drawer-cart" class="drawer" aria-label="Keranjang oleh-oleh" aria-hidden="true">
    <div class="drawer-head">
        <h2>Keranjang oleh-oleh</h2>
        <button class="x" type="button" data-close aria-label="Tutup keranjang">×</button>
    </div>
    <div class="drawer-body">
        <div id="cart-view">
            <ul id="cart-list" class="cart-list"></ul>
            <p id="cart-empty" class="empty">Keranjang masih kosong. <a href="{{ route('oleh-oleh') }}">Pilih oleh-oleh</a> dari perajin Aceh.</p>
        </div>

        <form id="co-form" hidden novalidate>
            <p class="co-sum">Total barang <strong id="co-total">Rp 0</strong></p>
            <label for="co-nama">Nama penerima</label>
            <input id="co-nama" name="nama" autocomplete="name" required>
            <label for="co-wa">Nomor WhatsApp</label>
            <input id="co-wa-in" name="wa" inputmode="tel" autocomplete="tel" required>
            <label for="co-kota">Kota atau kabupaten tujuan</label>
            <input id="co-kota" name="kota" required>
            <label for="co-alamat">Alamat lengkap</label>
            <textarea id="co-alamat" name="alamat" rows="3" required></textarea>
            <label for="co-catatan">Catatan (opsional)</label>
            <textarea id="co-catatan" name="catatan" rows="2"></textarea>
            <p id="co-err" class="err" role="alert"></p>
            <p class="small">Belum ada pembayaran di langkah ini. Admin akan menghubungi Anda lewat WhatsApp.</p>
            <div class="co-actions">
                <button class="btn cabai" type="submit">Kirim pesanan</button>
                <button class="btn ghost-dark" type="button" id="co-back">Kembali</button>
            </div>
        </form>

        <div id="co-done" hidden>
            <h3>Terima kasih, pesanan Anda sudah kami terima</h3>
            <p>Kode pesanan</p>
            <p class="kode" id="co-kode"></p>
            <p>Total barang (belum ongkir): <strong id="co-total2"></strong></p>
            <p>Langkah berikutnya: kirim kode ini lewat WhatsApp agar admin menghitung ongkos kirim dan memberi tahu cara pembayaran.</p>
            <a class="btn cabai" id="co-wa" href="#" target="_blank" rel="noopener">Konfirmasi lewat WhatsApp</a>
            <button class="btn ghost-dark" type="button" data-close>Selesai</button>
        </div>
    </div>
    <div class="drawer-foot" id="cart-foot" hidden>
        <div class="sub"><span>Subtotal</span><strong id="cart-total">Rp 0</strong></div>
        <p class="small">Ongkos kirim dihitung admin dan dikonfirmasi lewat WhatsApp.</p>
        <button class="btn cabai block-btn" type="button" id="btn-checkout">Lanjut ke pemesanan</button>
    </div>
</aside>

{{-- Resep tersimpan --}}
<aside id="drawer-fav" class="drawer" aria-label="Resep tersimpan" aria-hidden="true">
    <div class="drawer-head">
        <h2>Resep tersimpan</h2>
        <button class="x" type="button" data-close aria-label="Tutup resep tersimpan">×</button>
    </div>
    <div class="drawer-body">
        <ul id="fav-list" class="cart-list"></ul>
        <p id="fav-empty" class="empty">Belum ada resep tersimpan. Ketuk ikon hati pada resep yang ingin Anda masak nanti.</p>
    </div>
</aside>
</body>
</html>

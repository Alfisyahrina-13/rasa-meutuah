<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex,nofollow">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin') | Admin Rasa Meutuah</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@600;700&family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body>
@php
    $pesananBaru = \App\Models\Pesanan::where('status', 'baru')->count();
    $pesanBaru = \App\Models\Pesan::where('dibaca', false)->count();
@endphp
<div class="shell">
    <aside class="side">
        <a class="brand" href="{{ route('admin.dashboard') }}"><span class="mark" aria-hidden="true"></span>Rasa Meutuah <small>Admin</small></a>
        <nav aria-label="Menu admin">
            <a href="{{ route('admin.dashboard') }}" @class(['on' => request()->routeIs('admin.dashboard')])>Dashboard</a>
            <p class="grp">Konten</p>
            @foreach (config('admin.resources') as $key => $r)
                <a href="{{ route('admin.crud.index', $key) }}" @class(['on' => request()->is("admin/$key*")])>{{ $r['label'] }}</a>
            @endforeach
            <p class="grp">Masuk</p>
            <a href="{{ route('admin.pesanan.index') }}" @class(['on' => request()->routeIs('admin.pesanan.*')])>Pesanan @if($pesananBaru)<b>{{ $pesananBaru }}</b>@endif</a>
            <a href="{{ route('admin.pesan.index') }}" @class(['on' => request()->routeIs('admin.pesan.*')])>Pesan kontak @if($pesanBaru)<b>{{ $pesanBaru }}</b>@endif</a>
        </nav>
        <div class="side-foot">
            <a href="{{ route('home') }}" target="_blank" rel="noopener">Lihat situs</a>
            <form method="POST" action="{{ route('admin.logout') }}">@csrf<button type="submit">Keluar</button></form>
        </div>
    </aside>

    <main class="main">
        @if (session('ok'))<div class="flash" role="status">{{ session('ok') }}</div>@endif
        @yield('content')
    </main>
</div>
</body>
</html>

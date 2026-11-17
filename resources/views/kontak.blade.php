@extends('layouts.app')
@section('title', 'Kontak')

@section('content')
<section class="page-head"><div class="wrap">
    <h1>Kontak</h1>
    <p>Punya usul hidangan atau tradisi yang belum ada di sini? Kirim lewat formulir ini.</p>
</div></section>

<section class="wrap block narrow">
    @if (session('sukses'))
        <div class="alert ok" role="status">{{ session('sukses') }}</div>
    @endif

    <form class="form" method="POST" action="{{ route('kontak.kirim') }}" novalidate>
        @csrf
        <label for="nama">Nama</label>
        <input id="nama" name="nama" value="{{ old('nama') }}" required>
        @error('nama')<small class="err">{{ $message }}</small>@enderror

        <label for="email">Email</label>
        <input id="email" type="email" name="email" value="{{ old('email') }}" required>
        @error('email')<small class="err">{{ $message }}</small>@enderror

        <label for="pesan">Pesan</label>
        <textarea id="pesan" name="pesan" rows="6" required>{{ old('pesan') }}</textarea>
        @error('pesan')<small class="err">{{ $message }}</small>@enderror

        <button class="btn cabai" type="submit">Kirim pesan</button>
    </form>
</section>
@endsection

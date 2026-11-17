@extends('admin.layout')
@section('title', 'Pesan kontak')

@section('content')
<h1>Pesan dari formulir kontak</h1>

@if ($items->isEmpty())
    <p class="muted">Belum ada pesan.</p>
@else
    @foreach ($items as $m)
        <article class="panel msg @unless($m->dibaca) baru @endunless">
            <div class="panel-head">
                <div>
                    <strong>{{ $m->nama }}</strong>
                    <a href="mailto:{{ $m->email }}">{{ $m->email }}</a>
                    <small class="muted">{{ $m->created_at->format('d M Y H:i') }}</small>
                </div>
                @unless($m->dibaca)<span class="badge s-baru">belum dibaca</span>@endunless
            </div>
            <p>{!! nl2br(e($m->pesan)) !!}</p>
            <div class="aksi">
                <form method="POST" action="{{ route('admin.pesan.update', $m) }}">@csrf @method('PATCH')
                    <button type="submit">{{ $m->dibaca ? 'Tandai belum dibaca' : 'Tandai sudah dibaca' }}</button></form>
                <form method="POST" action="{{ route('admin.pesan.destroy', $m) }}" onsubmit="return confirm('Hapus pesan ini?')">@csrf @method('DELETE')
                    <button type="submit" class="danger">Hapus</button></form>
            </div>
        </article>
    @endforeach
    {{ $items->links('pagination::default') }}
@endif
@endsection

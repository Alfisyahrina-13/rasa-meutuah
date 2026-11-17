@extends('admin.layout')
@section('title', $c['label'])

@section('content')
<div class="bar-top">
    <h1>{{ $c['label'] }}</h1>
    <a class="btn" href="{{ route('admin.crud.create', $resource) }}">Tambah baru</a>
</div>

<form class="cari" method="GET" action="{{ route('admin.crud.index', $resource) }}">
    <label class="sr" for="q">Cari nama</label>
    <input id="q" type="search" name="q" value="{{ request('q') }}" placeholder="Cari nama">
    <button class="btn ghost" type="submit">Cari</button>
</form>

@if ($items->isEmpty())
    <p class="muted">Belum ada data.</p>
@else
<div class="scroll"><table>
    <thead><tr><th>Foto</th>@foreach ($c['kolom'] as $label)<th>{{ $label }}</th>@endforeach<th></th></tr></thead>
    <tbody>
    @foreach ($items as $item)
        <tr>
            <td>
                <span class="thumb">
                    @if ($item->foto_url)<img src="{{ $item->foto_url }}" alt="" loading="lazy">@else {{ mb_strtoupper(mb_substr($item->nama, 0, 1)) }} @endif
                </span>
            </td>
            @foreach ($c['kolom'] as $k => $label)
                <td>
                    @if ($k === 'unggulan') {{ $item->$k ? 'Ya' : '-' }}
                    @elseif ($k === 'harga') Rp {{ number_format($item->$k, 0, ',', '.') }}
                    @else {{ \Illuminate\Support\Str::limit($item->$k, 46) }}
                    @endif
                </td>
            @endforeach
            <td class="aksi">
                @if (! empty($c['rute_publik']))<a href="{{ route($c['rute_publik'], $item->slug) }}" target="_blank" rel="noopener">Lihat</a>@endif
                <a href="{{ route('admin.crud.edit', [$resource, $item->id]) }}">Ubah</a>
                <form method="POST" action="{{ route('admin.crud.destroy', [$resource, $item->id]) }}" onsubmit="return confirm('Hapus {{ addslashes($item->nama) }}? Tindakan ini tidak bisa dibatalkan.')">
                    @csrf @method('DELETE')
                    <button type="submit" class="danger">Hapus</button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table></div>
{{ $items->links('pagination::default') }}
@endif
@endsection

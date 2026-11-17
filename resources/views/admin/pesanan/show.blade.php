@extends('admin.layout')
@section('title', 'Pesanan '.$p->kode)

@section('content')
<a class="back" href="{{ route('admin.pesanan.index') }}">Kembali ke pesanan</a>
<h1>Pesanan {{ $p->kode }}</h1>

<div class="two">
    <section class="panel">
        <h2>Pembeli</h2>
        <dl>
            <dt>Nama</dt><dd>{{ $p->nama }}</dd>
            <dt>WhatsApp</dt><dd>{{ $p->wa }} <a href="{{ $waUrl }}" target="_blank" rel="noopener">Hubungi</a></dd>
            <dt>Kota / kabupaten</dt><dd>{{ $p->kota }}</dd>
            <dt>Alamat</dt><dd>{!! nl2br(e($p->alamat)) !!}</dd>
            @if ($p->catatan)<dt>Catatan</dt><dd>{!! nl2br(e($p->catatan)) !!}</dd>@endif
            <dt>Masuk</dt><dd>{{ $p->created_at->format('d M Y H:i') }}</dd>
        </dl>
    </section>

    <section class="panel">
        <h2>Status</h2>
        <form class="inline" method="POST" action="{{ route('admin.pesanan.update', $p) }}">
            @csrf @method('PATCH')
            <label class="sr" for="status">Status pesanan</label>
            <select id="status" name="status">
                @foreach ($statusList as $s)<option value="{{ $s }}" @selected($p->status === $s)>{{ ucfirst($s) }}</option>@endforeach
            </select>
            <button class="btn" type="submit">Simpan</button>
        </form>
        <form method="POST" action="{{ route('admin.pesanan.destroy', $p) }}" onsubmit="return confirm('Hapus pesanan ini?')">
            @csrf @method('DELETE')
            <button class="danger link" type="submit">Hapus pesanan</button>
        </form>
    </section>
</div>

<section class="panel">
    <h2>Barang</h2>
    <div class="scroll"><table>
        <thead><tr><th>Produk</th><th>Ukuran</th><th>Harga</th><th>Jumlah</th><th>Subtotal</th></tr></thead>
        <tbody>
        @foreach ($p->items as $i)
            <tr>
                <td>{{ $i['nama'] }}</td><td>{{ $i['ukuran'] }}</td>
                <td>Rp {{ number_format($i['harga'], 0, ',', '.') }}</td><td>{{ $i['qty'] }}</td>
                <td>Rp {{ number_format($i['subtotal'], 0, ',', '.') }}</td>
            </tr>
        @endforeach
        </tbody>
        <tfoot><tr><th colspan="4">Total barang (belum ongkir)</th><th>Rp {{ number_format($p->total, 0, ',', '.') }}</th></tr></tfoot>
    </table></div>
</section>
@endsection

@extends('admin.layout')
@section('title', 'Dashboard')

@section('content')
<h1>Dashboard</h1>

<div class="stats">
    @foreach ($stat as [$label, $jumlah, $rute, $param])
        <a class="stat" href="{{ route($rute, $param) }}"><span>{{ $label }}</span><strong>{{ $jumlah }}</strong></a>
    @endforeach
    <a class="stat hot" href="{{ route('admin.pesanan.index', ['status' => 'baru']) }}"><span>Pesanan baru</span><strong>{{ $pesananBaru }}</strong></a>
    <a class="stat hot" href="{{ route('admin.pesan.index') }}"><span>Pesan belum dibaca</span><strong>{{ $pesanBaru }}</strong></a>
</div>

<section class="panel">
    <div class="panel-head"><h2>Pesanan terbaru</h2><a href="{{ route('admin.pesanan.index') }}">Lihat semua</a></div>
    @if ($terbaru->isEmpty())
        <p class="muted">Belum ada pesanan masuk.</p>
    @else
        <div class="scroll"><table>
            <thead><tr><th>Kode</th><th>Nama</th><th>Total</th><th>Status</th><th>Waktu</th></tr></thead>
            <tbody>
            @foreach ($terbaru as $p)
                <tr>
                    <td><a href="{{ route('admin.pesanan.show', $p) }}">{{ $p->kode }}</a></td>
                    <td>{{ $p->nama }}</td>
                    <td>Rp {{ number_format($p->total, 0, ',', '.') }}</td>
                    <td><span class="badge s-{{ $p->status }}">{{ $p->status }}</span></td>
                    <td>{{ $p->created_at->format('d M Y H:i') }}</td>
                </tr>
            @endforeach
            </tbody>
        </table></div>
    @endif
</section>
@endsection

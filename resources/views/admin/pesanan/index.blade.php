@extends('admin.layout')
@section('title', 'Pesanan')

@section('content')
<h1>Pesanan oleh-oleh</h1>

<nav class="pills" aria-label="Filter status">
    <a href="{{ route('admin.pesanan.index') }}" @class(['on' => ! request('status')])>Semua</a>
    @foreach ($statusList as $s)
        <a href="{{ route('admin.pesanan.index', ['status' => $s]) }}" @class(['on' => request('status') === $s])>{{ ucfirst($s) }}</a>
    @endforeach
</nav>

@if ($items->isEmpty())
    <p class="muted">Belum ada pesanan.</p>
@else
<div class="scroll"><table>
    <thead><tr><th>Kode</th><th>Pembeli</th><th>Kota</th><th>Total</th><th>Status</th><th>Waktu</th></tr></thead>
    <tbody>
    @foreach ($items as $p)
        <tr>
            <td><a href="{{ route('admin.pesanan.show', $p) }}">{{ $p->kode }}</a></td>
            <td>{{ $p->nama }}</td>
            <td>{{ $p->kota }}</td>
            <td>Rp {{ number_format($p->total, 0, ',', '.') }}</td>
            <td><span class="badge s-{{ $p->status }}">{{ $p->status }}</span></td>
            <td>{{ $p->created_at->format('d M Y H:i') }}</td>
        </tr>
    @endforeach
    </tbody>
</table></div>
{{ $items->links('pagination::default') }}
@endif
@endsection

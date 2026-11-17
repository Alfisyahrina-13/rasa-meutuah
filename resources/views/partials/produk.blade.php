<article class="card produk">
    <div class="media">@include('partials.media', ['item' => $p])</div>
    <div class="card-body">
        <p class="perajin">{{ $p->perajin }}, {{ $p->lokasi }}</p>
        <h3>{{ $p->nama }}</h3>
        <p>{{ $p->deskripsi }}</p>
        <ul class="ticks">
            @foreach ($p->daftarFitur() as $f)<li>{{ $f }}</li>@endforeach
        </ul>
        <div class="buy">
            <div>
                <strong class="price">Rp {{ number_format($p->harga, 0, ',', '.') }}</strong>
                <small>{{ $p->ukuran }}</small>
            </div>
            <button type="button" class="btn cabai" data-add data-id="{{ $p->id }}" data-nama="{{ $p->nama }}"
                    data-harga="{{ $p->harga }}" data-ukuran="{{ $p->ukuran }}" data-foto="{{ $p->foto_url }}">Tambah</button>
        </div>
    </div>
</article>

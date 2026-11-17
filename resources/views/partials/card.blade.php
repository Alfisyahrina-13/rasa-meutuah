{{-- $item, $rute (kuliner.show / budaya.show), $label, $fav (opsional) --}}
@php($fav = $fav ?? false)
<article class="card">
    <a class="media" href="{{ route($rute, $item) }}" tabindex="-1" aria-hidden="true">@include('partials.media', ['item' => $item])</a>
    @if ($fav)
        <button type="button" class="fav" data-fav data-slug="{{ $item->slug }}" data-nama="{{ $item->nama }}"
                data-url="{{ route($rute, $item) }}" aria-pressed="false" aria-label="Simpan resep {{ $item->nama }}"></button>
    @endif
    <div class="card-body">
        <span class="tag">{{ $label }}</span>
        <h3><a href="{{ route($rute, $item) }}">{{ $item->nama }}</a></h3>
        <p>{{ $item->ringkasan }}</p>
    </div>
</article>

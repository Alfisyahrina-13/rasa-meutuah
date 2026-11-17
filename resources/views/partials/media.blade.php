@if ($item->foto_url)
    <img src="{{ $item->foto_url }}" alt="{{ $item->nama }}" loading="lazy">
@else
    <span class="mono" aria-hidden="true">{{ mb_strtoupper(mb_substr($item->nama, 0, 1)) }}</span>
@endif

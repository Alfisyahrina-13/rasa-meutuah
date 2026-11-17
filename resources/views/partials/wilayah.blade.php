<div class="wil">
    <div class="tabs" role="tablist" aria-label="Pilih wilayah">
        @foreach ($wilayahs as $w)
            <button type="button" role="tab" aria-selected="{{ $loop->first ? 'true' : 'false' }}">{{ $w->nama }}</button>
        @endforeach
    </div>

    @foreach ($wilayahs as $w)
        <div class="panel" role="tabpanel" @if(! $loop->first) hidden @endif>
            <div class="panel-art">@include('partials.media', ['item' => $w])</div>
            <div class="panel-text">
                <p class="julukan">{{ $w->julukan }}</p>
                <h3>{{ $w->nama }}</h3>
                <p>{{ $w->deskripsi }}</p>
                <h4>Sajian khas</h4>
                <p class="sajian">{{ $w->sajian }}</p>
                <h4>Tempat yang layak dikunjungi</h4>
                <ul class="places">
                    @foreach ($w->daftarTempat() as $t)
                        <li><a href="https://www.google.com/maps/search/?api=1&query={{ urlencode($t.' Aceh') }}" target="_blank" rel="noopener">{{ $t }}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endforeach
</div>

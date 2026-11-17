@extends('admin.layout')
@php
    $edit = $item->exists;
@endphp
@section('title', ($edit ? 'Ubah ' : 'Tambah ').$c['label'])

@section('content')
<a class="back" href="{{ route('admin.crud.index', $resource) }}">Kembali ke daftar {{ $c['label'] }}</a>
<h1>{{ $edit ? 'Ubah '.$item->nama : 'Tambah '.$c['label'] }}</h1>

<form class="form" method="POST" enctype="multipart/form-data"
      action="{{ $edit ? route('admin.crud.update', [$resource, $item->id]) : route('admin.crud.store', $resource) }}">
    @csrf
    @if ($edit) @method('PUT') @endif

    @foreach ($c['fields'] as $f)
        @php
            $n = $f['name'];
            $val = old($n, $item->{$n} ?? ($f['default'] ?? ''));
        @endphp
        <div class="field">
            @if ($f['type'] === 'checkbox')
                <label class="cek"><input type="hidden" name="{{ $n }}" value="0"><input type="checkbox" name="{{ $n }}" value="1" @checked($val)> {{ $f['label'] }}</label>

            @elseif ($f['type'] === 'image')
                <label for="{{ $n }}">{{ $f['label'] }}</label>
                @if ($edit && $item->foto_url)
                    <img class="preview" src="{{ $item->foto_url }}" alt="Foto saat ini">
                @endif
                <input id="{{ $n }}" type="file" name="{{ $n }}" accept="image/jpeg,image/png,image/webp">
                <small class="hint">JPG, PNG, atau WEBP, maksimal 5 MB. Disarankan lebar 1600 px.</small>
                @if ($edit && $item->gambar)
                    <label class="cek"><input type="checkbox" name="hapus_gambar" value="1"> Hapus foto yang diunggah</label>
                @endif

            @elseif ($f['type'] === 'textarea')
                <label for="{{ $n }}">{{ $f['label'] }}@if(! empty($f['required'])) <em>*</em>@endif</label>
                <textarea id="{{ $n }}" name="{{ $n }}" rows="{{ in_array($n, ['deskripsi', 'langkah']) ? 7 : 4 }}">{{ $val }}</textarea>
                @if (! empty($f['hint']))<small class="hint">{{ $f['hint'] }}</small>@endif

            @else
                <label for="{{ $n }}">{{ $f['label'] }}@if(! empty($f['required'])) <em>*</em>@endif</label>
                <input id="{{ $n }}" name="{{ $n }}" value="{{ $val }}"
                       type="{{ $f['type'] === 'number' ? 'number' : 'text' }}" @if($f['type'] === 'number') min="0" @endif
                       @if($f['type'] === 'combo') list="dl-{{ $n }}" @endif>
                @if ($f['type'] === 'combo')
                    <datalist id="dl-{{ $n }}">@foreach ($f['options'] as $o)<option value="{{ $o }}">@endforeach</datalist>
                @endif
                @if (! empty($f['hint']))<small class="hint">{{ $f['hint'] }}</small>@endif
            @endif

            @error($n)<small class="err">{{ $message }}</small>@enderror
        </div>
    @endforeach

    @if ($edit && $item->slug)<p class="muted">Alamat halaman (slug): <code>{{ $item->slug }}</code>. Slug tidak berubah saat nama diubah.</p>@endif

    <div class="form-actions">
        <button class="btn" type="submit">{{ $edit ? 'Simpan perubahan' : 'Simpan' }}</button>
        <a class="btn ghost" href="{{ route('admin.crud.index', $resource) }}">Batal</a>
    </div>
</form>
@endsection

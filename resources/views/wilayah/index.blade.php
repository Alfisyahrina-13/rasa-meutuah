@extends('layouts.app')
@section('title', 'Wilayah')

@section('content')
<section class="page-head"><div class="wrap">
    <h1>Wilayah Aceh</h1>
    <p>Pilih wilayah untuk melihat sajian khas dan tempat yang layak dikunjungi.</p>
</div></section>
<section class="wrap block">
    @include('partials.wilayah', ['wilayahs' => $wilayahs])
</section>
@endsection

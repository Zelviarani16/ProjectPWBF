@extends('layouts.main')

@section('title', 'Struktur Organisasi')

@section('content')
<section id="struktur" class="section">
  <h2>Struktur Organisasi RSHP</h2>
  <p>
    RSHP UNAIR dipimpin oleh seorang <em>Direktur RSHP</em> yang membawahi unit-unit pelayanan dan penunjang.
  </p>
  <div class="struktur">
    <img src="{{ asset('images/struktur.png') }}" alt="Struktur organisasi RSHP">
  </div>
</section>
@endsection

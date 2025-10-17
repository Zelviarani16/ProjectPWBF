@extends('layouts.main')

@section('title', 'RSHP Universitas Airlangga')

@section('content')
<section id="home" class="section hero">
  <div class="hero-content">
    <h2 id="home-title">Selamat Datang di RSHP UNAIR</h2>
    <p>
      <b>RSHP Universitas Airlangga</b> adalah fasilitas pelayanan kesehatan hewan
      sekaligus wahana "Pendidikan, Penelitian, dan Pengabdian Masyarakat" Tri Dharma perguruan tinggi.
      Kami melayani pemeriksaan klinik, tindakan bedah minor, vaksinasi, steril, dan layanan penunjang lain
      untuk berbagai jenis hewan kesayangan.
    </p>

    <figure class="hero-figure">
      <img src="{{ asset('images/rshpua.jpg') }}" alt="Gedung dan fasilitas RSHP UNAIR">
    </figure>

    <aside class="info-box">
      <h3>Info Singkat</h3>
      <ul>
        <li><b>Lokasi:</b> Surabaya</li>
        <li><b>Waktu Layanan:</b> Senin–Jumat, 08.00–16.00 WIB</li>
        <li><b>Kontak:</b>
          <a href="tel:+62000000000">+62 000-0000-000</a> &middot;
          <a href="mailto:halo@rshp.unair.ac.id">halo@rshp.unair.ac.id</a>
        </li>
      </ul>
      <p class="note"><sup>*</sup>Jam dapat berubah pada hari libur nasional.</p>
    </aside>
  </div>
</section>
@endsection

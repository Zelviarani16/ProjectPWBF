@extends('layouts.main')

@section('title', 'Layanan Umum')

@section('content')
<section id="layanan" class="section">
  <h2 id="layanan-title">Layanan Umum</h2>
  <p>Berikut beberapa layanan yang umum tersedia di RSHP.</p>

  <table class="layanan-table">
    <thead>
      <tr>
        <th>Jenis Layanan</th>
        <th>Deskripsi</th>
        <th>Detail</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>Poliklinik &amp; Konsultasi</td>
        <td>Pemeriksaan umum, <strong>diagnosis</strong>, terapi, dan rujukan lanjutan bila diperlukan.</td>
        <td>
          <ul>
            <li>Vaksinasi anjing &amp; kucing</li>
            <li>Pengobatan penyakit kulit</li>
            <li>Perawatan gigi dan mulut</li>
          </ul>
        </td>
      </tr>
      <tr>
        <td>Bedah Minor</td>
        <td>Penanganan bedah minor seperti <em>sterilisasi</em> dan penjahitan luka ringan.</td>
        <td>
          <ol>
            <li>Pra-bedah (pemeriksaan &amp; persetujuan)</li>
            <li>Tindakan bedah</li>
            <li>Kontrol pasca-bedah</li>
          </ol>
        </td>
      </tr>
      <tr>
        <td>Laboratorium</td>
        <td>Pemeriksaan hematologi, kimia darah, dan parasitologi untuk mendukung <i>evidence-based practice</i>.</td>
        <td>
          <dl>
            <dt>Hematologi</dt>
            <dd>Hitung darah lengkap</dd>
            <dt>Kimia darah</dt>
            <dd>Fungsi hati &amp; ginjal</dd>
          </dl>
        </td>
      </tr>
    </tbody>
  </table>

  <figure class="gallery">
    <h3>Galeri Fasilitas RSHP Universitas Airlangga</h3>
    <div class="gallery-item">
      <img src="{{ asset('images/ruangan.jpg') }}" alt="Ruang klinik RSHP">
      <figcaption>Ruang Klinik RSHP</figcaption>
    </div>
    <div class="gallery-item">
      <img src="{{ asset('images/labolatorium.jpg') }}" alt="Peralatan laboratorium veteriner" />
      <figcaption>Laboratorium Veteriner</figcaption>
    </div>
    <div class="gallery-item">
      <img src="{{ asset('images/frontoffice.jpg') }}" alt="Front office dan ruang tunggu" />
      <figcaption>Front Office & Ruang Tunggu</figcaption>
    </div>
    <div class="gallery-item">
      <img src="{{ asset('images/bedah.jpg') }}" alt="Ruang bedah RSHP">
      <figcaption>Ruang Bedah RSHP</figcaption>
    </div>
  </figure>

  <div class="quotegambar">
    <p>“Pelayanan prima untuk kesehatan hewan adalah bagian dari pengabdian kami pada masyarakat.”</p>
  </div>
</section>
@endsection

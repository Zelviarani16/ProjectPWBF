<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>@yield('title')</title>
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>
  <!-- Header -->
  <header class="site-header">
    <div class="brand">
      <h1>RSHP Universitas Airlangga</h1>
      <p class="tagline"><em>Rumah Sakit Hewan Pendidikan</em></p>
    </div>

    <nav class="top-nav">
      <ul>
        <li><a href="{{ route('home') }}">Home</a></li>
        <li><a href="{{ route('struktur') }}">Struktur Organisasi</a></li>
        <li><a href="{{ route('layanan') }}">Layanan Umum</a></li>
        <li><a href="{{ route('kontak') }}">Kontak</a></li>
        <li><a href="{{ route('login') }}">Login</a></li>
      </ul>
    </nav>
  </header>

  <!-- Main Content -->
  <main>
    @yield('content')
  </main>

  <!-- Footer -->
  <footer>
    <div class="links">
      <a href="{{ route('home') }}">Home</a>
      <a href="{{ route('struktur') }}">Struktur Organisasi</a>
      <a href="{{ route('layanan') }}">Layanan Umum</a>
      <a href="{{ route('kontak') }}">Kontak</a>
    </div>
    <div class="credit">
      <p>Created by <a href="#">zelviarani</a> | &copy; 2025</p>
    </div>
  </footer>
</body>
</html>

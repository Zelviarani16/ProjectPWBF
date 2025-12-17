<!-- INI YG HALAMAN AWAL RSHP -->

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
        <li><a href="{{ route('landing') }}">Home</a></li>
        <li><a href="{{ route('struktur') }}">Struktur Organisasi</a></li>
        <li><a href="{{ route('layanan') }}">Layanan Umum</a></li>
        <li><a href="{{ route('kontak') }}">Kontak</a></li>

        <!-- guest adalah blade directive yg hanya menampilkan konten jika user belum login -->
        <!-- Setelah klik login di navbar, browser request /login (GET), dan di routes itu mengarah ke logincontroller@showLoginForm -->
        @guest
      <li><a href="{{ route('login') }}">Login</a></li>
    @endguest

    <!-- auth -> tampilkan konten jika user sdh login -->
    @auth
      <li>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
          @csrf
        </form>
        <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
          Logout {{ Auth::user()->name }}
        </a>
      </li>
    @endauth
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
      <a href="landing">Home</a>
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

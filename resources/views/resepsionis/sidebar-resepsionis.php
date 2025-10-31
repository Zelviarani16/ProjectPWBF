<div class="sidebar">
    <!-- Sidebar Header -->
    <div class="sidebar-header">
        <div class="logo-container">
            <i class="bi bi-hospital-fill"></i>
            <div class="logo-text">
                <h4>RSHP Panel</h4>
                <span>Resepsionis Dashboard</span>
            </div>
        </div>
    </div>

    <!-- User Profile Section -->
    <div class="user-profile">
        <div class="user-avatar">
            <i class="bi bi-person-circle"></i>
        </div>
        <div class="user-info">
            <h5>{{ Auth::user()->name }}</h5>
            <span class="user-role">{{ Auth::user()->role ?? 'Resepsionis' }}</span>
            <span class="user-email">{{ Auth::user()->email }}</span>
        </div>
    </div>

    <!-- Navigation Menu -->
    <div class="sidebar-menu">

        <div class="menu-section">
            <div class="menu-title">
                <i class="bi bi-grid"></i> Main Menu
            </div>
            <a href="{{ route('resepsionis.dashboard') }}" class="menu-item {{ request()->routeIs('resepsionis.dashboard') ? 'active' : '' }}">
                <i class="bi bi-speedometer2"></i>
                <span>Dashboard</span>
            </a>
        </div>

        <div class="menu-section">
            <div class="menu-title">
                <i class="bi bi-database"></i> Data
            </div>
            <a href="{{ route('admin.pet.index') }}" class="menu-item {{ request()->routeIs('admin.pet.*') ? 'active' : '' }}">
                <i class="bi bi-heart"></i>
                <span>Data Pet</span>
            </a>
            <a href="{{ route('admin.user.index') }}" class="menu-item {{ request()->routeIs('admin.user.*') ? 'active' : '' }}">
                <i class="bi bi-people"></i>
                <span>Data Pemilik</span>
            </a>
            <a href="{{ route('admin.temu-dokter.index') }}" class="menu-item {{ request()->routeIs('admin.temu-dokter.*') ? 'active' : '' }}">
                <i class="bi bi-journal-medical"></i>
                <span>Temu Dokter</span>
            </a>
        </div>

        <!-- Logout -->
        <div class="menu-section">
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
            <a href="#" class="menu-item logout-btn" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="bi bi-box-arrow-right"></i>
                <span>Logout</span>
            </a>
        </div>

    </div>
</div>

<!-- Content -->
<div class="main-wrapper">
    <div class="content-area">
        @yield('content')
    </div>
</div>

<!-- Style CSS -->
<style>
    /* Sidebar sama seperti admin, bisa pakai CSS lama */
    .sidebar { width: 280px; background: linear-gradient(180deg, #1e3a8a 0%, #1e40af 100%); height: 100vh; position: fixed; left: 0; top: 0; overflow-y: auto; box-shadow: 4px 0 10px rgba(0,0,0,0.1); z-index: 1000; }
    .sidebar-header, .user-profile, .sidebar-menu { /* gunakan CSS yang sudah ada */ }
    .menu-item.active { background: rgba(96, 165, 250, 0.2); color: white; border-left: 4px solid #60a5fa; }
</style>

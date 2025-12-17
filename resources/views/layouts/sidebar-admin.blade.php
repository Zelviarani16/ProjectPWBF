<div class="sidebar">
    <!-- Sidebar Header -->
    <div class="sidebar-header">
        <div class="logo-container">
            <i class="bi bi-hospital-fill"></i>
            <div class="logo-text">
                <h4>RSHP Panel</h4>
                <span>Admin Dashboard</span>
            </div>
        </div>
    </div>

    <!-- User Profile Section -->
    <div class="user-profile">
        <div class="user-avatar">
            <i class="bi bi-person-circle"></i>
        </div>
        <div class="user-info">
            <h5>{{ Auth::user()->nama }}</h5>
            <span class="user-role">
                {{ session('user_role_name') ?? 'Administrator' }}
            </span>
            <span class="user-email">{{ Auth::user()->email }}</span>
        </div>
    </div>

    <!-- Navigation Menu -->
    <div class="sidebar-menu">
        <div class="menu-section">
            <div class="menu-title">
                <i class="bi bi-grid"></i> Main Menu
            </div>
            <a href="{{ route('admin.dashboard') }}" class="menu-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="bi bi-speedometer2"></i>
                <span>Dashboard</span>
            </a>
        </div>

        <div class="menu-section">
            <div class="menu-title">
                <i class="bi bi-database"></i> Data Master
            </div>
            <a href="{{ route('admin.jenis-hewan.index') }}" class="menu-item {{ request()->routeIs('admin.jenis-hewan.*') ? 'active' : '' }}">
                <i class="bi bi-tag"></i>
                <span>Jenis Hewan</span>
            </a>
            <a href="{{ route('admin.ras-hewan.index') }}" class="menu-item {{ request()->routeIs('admin.ras-hewan.*') ? 'active' : '' }}">
                <i class="bi bi-tags"></i>
                <span>Ras Hewan</span>
            </a>
            <a href="{{ route('admin.kategori.index') }}" class="menu-item {{ request()->routeIs('admin.kategori.*') ? 'active' : '' }}">
                <i class="bi bi-folder"></i>
                <span>Kategori</span>
            </a>
            <a href="{{ route('admin.kategori-klinis.index') }}" class="menu-item {{ request()->routeIs('admin.kategori-klinis.*') ? 'active' : '' }}">
                <i class="bi bi-clipboard-pulse"></i>
                <span>Kategori Klinis</span>
            </a>
            <a href="{{ route('admin.kode-tindakan-terapi.index') }}" class="menu-item {{ request()->routeIs('admin.kode-tindakan-terapi.*') ? 'active' : '' }}">
                <i class="bi bi-file-medical"></i>
                <span>Kode Tindakan Terapi</span>
            </a>
        </div>

        <div class="menu-section">
            <div class="menu-title">
                <i class="bi bi-gear"></i> Management
            </div>
            <a href="{{ route('admin.pet.index') }}" class="menu-item {{ request()->routeIs('admin.pet.*') ? 'active' : '' }}">
                <i class="bi bi-heart"></i>
                <span>Pet</span>
            </a>
            <a href="{{ route('admin.user.index') }}" class="menu-item {{ request()->routeIs('admin.user.*') ? 'active' : '' }}">
                <i class="bi bi-people"></i>
                <span>User</span>
            </a>
            <a href="{{ route('admin.user-role.index') }}" class="menu-item {{ request()->routeIs('admin.user-role.*') ? 'active' : '' }}">
                <i class="bi bi-shield-check"></i>
                <span>Role</span>
            </a>
            <a href="{{ route('admin.pemilik.index') }}" class="menu-item {{ request()->routeIs('admin.pemilik.*') ? 'active' : '' }}">
                <i class="bi bi-shield-check"></i>
                <span>Pemilik</span>
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

<style>
    .sidebar {
        width: 280px;
        background: linear-gradient(180deg, #1e3a8a 0%, #1e40af 100%);
        height: 100vh;
        position: fixed;
        left: 0;
        top: 0;
        overflow-y: auto;
        box-shadow: 4px 0 10px rgba(0,0,0,0.1);
        z-index: 1000;
    }

    .sidebar::-webkit-scrollbar {
        width: 6px;
    }

    .sidebar::-webkit-scrollbar-track {
        background: rgba(255,255,255,0.1);
    }

    .sidebar::-webkit-scrollbar-thumb {
        background: rgba(255,255,255,0.3);
        border-radius: 3px;
    }

    .sidebar-header {
        padding: 20px;
        background: rgba(0,0,0,0.2);
        border-bottom: 1px solid rgba(255,255,255,0.1);
    }

    .logo-container {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .logo-container i {
        font-size: 40px;
        color: #60a5fa;
    }

    .logo-text h4 {
        margin: 0;
        color: white;
        font-size: 22px;
        font-weight: 700;
        letter-spacing: 0.5px;
    }

    .logo-text span {
        color: #93c5fd;
        font-size: 12px;
        font-weight: 400;
    }

    /* User Profile Section */
    .user-profile {
        padding: 20px;
        background: rgba(0,0,0,0.15);
        border-bottom: 1px solid rgba(255,255,255,0.1);
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .user-avatar {
        flex-shrink: 0;
    }

    .user-avatar i {
        font-size: 50px;
        color: #60a5fa;
    }

    .user-info {
        flex: 1;
        min-width: 0;
    }

    .user-info h5 {
        margin: 0 0 5px 0;
        color: white;
        font-size: 16px;
        font-weight: 600;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .user-role {
        display: inline-block;
        background: rgba(96, 165, 250, 0.3);
        color: #93c5fd;
        padding: 2px 10px;
        border-radius: 12px;
        font-size: 11px;
        font-weight: 500;
        margin-bottom: 5px;
    }

    .user-email {
        display: block;
        color: rgba(255,255,255,0.6);
        font-size: 12px;
        margin-top: 5px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    /* Sidebar Menu */
    .sidebar-menu {
        padding: 10px 0;
    }

    .menu-section {
        margin-bottom: 10px;
    }

    .menu-title {
        padding: 15px 20px 10px;
        color: #93c5fd;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .menu-title i {
        font-size: 13px;
    }

    .menu-item {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 12px 20px;
        color: rgba(255,255,255,0.8);
        text-decoration: none;
        transition: all 0.3s ease;
        position: relative;
        font-size: 14px;
    }

    .menu-item:hover {
        background: rgba(255,255,255,0.1);
        color: white;
        padding-left: 25px;
    }

    .menu-item i {
        font-size: 18px;
        width: 20px;
        text-align: center;
    }

    .menu-item.active {
        background: rgba(96, 165, 250, 0.2);
        color: white;
        border-left: 4px solid #60a5fa;
        padding-left: 16px;
        font-weight: 600;
    }

    .menu-item.active i {
        color: #60a5fa;
    }

    .logout-btn {
        margin-top: 10px;
        border-top: 1px solid rgba(255,255,255,0.1);
        padding-top: 20px !important;
        color: #fca5a5;
    }

    .logout-btn:hover {
        background: rgba(220, 38, 38, 0.2);
        color: #fca5a5;
    }

    .logout-btn i {
        color: #fca5a5;
    }

    /* Main Wrapper */
    .main-wrapper {
        margin-left: 280px;
        min-height: 100vh;
        background: #f3f4f6;
    }

    .content-area {
        padding: 30px;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .sidebar {
            width: 250px;
            transform: translateX(-100%);
            transition: transform 0.3s ease;
        }

        .sidebar.active {
            transform: translateX(0);
        }

        .main-wrapper {
            margin-left: 0;
        }
    }
</style>
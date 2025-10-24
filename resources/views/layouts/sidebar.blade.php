<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') - Klinik Hewan Admin</title>
    
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --sidebar-width: 280px;
            --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --primary-color: #667eea;
            --primary-dark: #5568d3;
            --secondary-color: #6c757d;
            --success-color: #10b981;
            --danger-color: #ef4444;
            --warning-color: #f59e0b;
            --info-color: #3b82f6;
            --dark-color: #1e293b;
            --light-bg: #f8fafc;
            --card-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            --hover-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--light-bg);
            color: #334155;
            overflow-x: hidden;
        }

        /* ============= SIDEBAR ============= */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: var(--sidebar-width);
            background: var(--primary-gradient);
            z-index: 1000;
            overflow-y: auto;
            transition: all 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55);
            box-shadow: 4px 0 24px rgba(102, 126, 234, 0.15);
        }

        .sidebar::-webkit-scrollbar {
            width: 5px;
        }

        .sidebar::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.05);
        }

        .sidebar::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.3);
            border-radius: 10px;
        }

        .sidebar::-webkit-scrollbar-thumb:hover {
            background: rgba(255, 255, 255, 0.5);
        }

        /* Brand Logo */
        .sidebar-brand {
            padding: 28px 24px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            display: flex;
            align-items: center;
            gap: 14px;
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
        }

        .brand-icon {
            width: 48px;
            height: 48px;
            background: rgba(255, 255, 255, 0.15);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 24px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .brand-text h4 {
            color: white;
            font-size: 20px;
            font-weight: 700;
            margin: 0;
            letter-spacing: -0.5px;
        }

        .brand-text p {
            color: rgba(255, 255, 255, 0.7);
            font-size: 11px;
            margin: 0;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        /* User Profile */
        .sidebar-profile {
            padding: 24px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            background: rgba(255, 255, 255, 0.03);
        }

        .profile-wrapper {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .profile-avatar {
            position: relative;
        }

        .avatar-img {
            width: 52px;
            height: 52px;
            border-radius: 50%;
            border: 3px solid rgba(255, 255, 255, 0.3);
            object-fit: cover;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }

        .avatar-status {
            position: absolute;
            bottom: 2px;
            right: 2px;
            width: 12px;
            height: 12px;
            background: var(--success-color);
            border: 2px solid white;
            border-radius: 50%;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.5; }
        }

        .profile-info h6 {
            color: white;
            font-size: 15px;
            font-weight: 600;
            margin: 0 0 2px 0;
            letter-spacing: -0.2px;
        }

        .profile-info p {
            color: rgba(255, 255, 255, 0.7);
            font-size: 12px;
            margin: 0;
            font-weight: 400;
        }

        /* Navigation Menu */
        .sidebar-nav {
            padding: 12px 0;
        }

        .nav-section-title {
            padding: 20px 24px 10px;
            color: rgba(255, 255, 255, 0.5);
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1.5px;
        }

        .nav-link-item {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 14px 24px;
            color: rgba(255, 255, 255, 0.85);
            text-decoration: none;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            font-weight: 500;
            font-size: 14px;
        }

        .nav-link-item::before {
            content: '';
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 0;
            height: 0;
            background: white;
            border-radius: 0 4px 4px 0;
            transition: all 0.3s ease;
        }

        .nav-link-item:hover {
            background: rgba(255, 255, 255, 0.1);
            color: white;
            padding-left: 32px;
        }

        .nav-link-item:hover::before {
            width: 4px;
            height: 32px;
        }

        .nav-link-item.active {
            background: rgba(255, 255, 255, 0.15);
            color: white;
            box-shadow: inset 0 0 20px rgba(255, 255, 255, 0.1);
        }

        .nav-link-item.active::before {
            width: 4px;
            height: 40px;
        }

        .nav-icon {
            width: 22px;
            height: 22px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
        }

        .nav-text {
            flex: 1;
        }

        .nav-badge {
            background: rgba(239, 68, 68, 0.9);
            color: white;
            padding: 2px 8px;
            border-radius: 10px;
            font-size: 10px;
            font-weight: 600;
        }

        /* ============= MAIN CONTENT ============= */
        .main-wrapper {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
            transition: all 0.4s ease;
        }

        /* Topbar */
        .topbar {
            background: white;
            padding: 18px 32px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08);
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 999;
            border-bottom: 1px solid #e2e8f0;
        }

        .topbar-left h5 {
            color: var(--dark-color);
            font-weight: 700;
            margin: 0;
            font-size: 22px;
            letter-spacing: -0.5px;
        }

        .breadcrumb-custom {
            display: flex;
            gap: 8px;
            align-items: center;
            margin-top: 4px;
            font-size: 13px;
            color: #64748b;
        }

        .breadcrumb-custom a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 500;
        }

        .topbar-right {
            display: flex;
            gap: 12px;
            align-items: center;
        }

        .topbar-btn {
            width: 42px;
            height: 42px;
            border-radius: 12px;
            background: var(--light-bg);
            border: none;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            color: #64748b;
            font-size: 20px;
            position: relative;
        }

        .topbar-btn:hover {
            background: var(--primary-color);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
        }

        .topbar-btn .notification-dot {
            position: absolute;
            top: 8px;
            right: 8px;
            width: 8px;
            height: 8px;
            background: var(--danger-color);
            border: 2px solid white;
            border-radius: 50%;
        }

        .datetime-display {
            padding: 10px 16px;
            background: var(--light-bg);
            border-radius: 10px;
            font-size: 13px;
            font-weight: 500;
            color: #64748b;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        /* Content Area */
        .content-area {
            padding: 32px;
        }

        /* Page Header */
        .page-header {
            margin-bottom: 32px;
        }

        .page-title {
            font-size: 28px;
            font-weight: 700;
            color: var(--dark-color);
            margin: 0 0 8px 0;
            letter-spacing: -0.5px;
        }

        .page-subtitle {
            color: #64748b;
            font-size: 15px;
            margin: 0;
        }

        /* Card Styles */
        .card {
            border: none;
            border-radius: 16px;
            box-shadow: var(--card-shadow);
            margin-bottom: 24px;
            transition: all 0.3s ease;
            background: white;
            overflow: hidden;
        }

        .card:hover {
            transform: translateY(-4px);
            box-shadow: var(--hover-shadow);
        }

        .card-header {
            background: white;
            border-bottom: 1px solid #e2e8f0;
            padding: 20px 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .card-title {
            font-size: 18px;
            font-weight: 700;
            color: var(--dark-color);
            margin: 0;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .card-title i {
            color: var(--primary-color);
        }

        .card-body {
            padding: 24px;
        }

        /* Alert Styles */
        .alert {
            border-radius: 12px;
            border: none;
            padding: 16px 20px;
            margin-bottom: 24px;
            display: flex;
            align-items: center;
            gap: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            animation: slideDown 0.4s ease-out;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .alert i {
            font-size: 20px;
        }

        .alert-success {
            background: #ecfdf5;
            color: #065f46;
            border-left: 4px solid var(--success-color);
        }

        .alert-danger {
            background: #fef2f2;
            color: #991b1b;
            border-left: 4px solid var(--danger-color);
        }

        .alert-warning {
            background: #fffbeb;
            color: #92400e;
            border-left: 4px solid var(--warning-color);
        }

        .alert-info {
            background: #eff6ff;
            color: #1e40af;
            border-left: 4px solid var(--info-color);
        }

        /* Table Styles */
        .table-wrapper {
            overflow-x: auto;
            border-radius: 12px;
        }

        .table {
            margin-bottom: 0;
        }

        .table thead th {
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
            color: var(--dark-color);
            font-weight: 700;
            text-transform: uppercase;
            font-size: 12px;
            letter-spacing: 0.5px;
            border: none;
            padding: 18px 20px;
            white-space: nowrap;
        }

        .table tbody td {
            padding: 16px 20px;
            vertical-align: middle;
            border-bottom: 1px solid #f1f5f9;
            color: #475569;
        }

        .table tbody tr {
            transition: all 0.2s ease;
        }

        .table tbody tr:hover {
            background: #f8fafc;
            transform: scale(1.01);
        }

        .table tbody tr:last-child td {
            border-bottom: none;
        }

        /* Button Styles */
        .btn {
            border-radius: 10px;
            padding: 10px 20px;
            font-weight: 600;
            transition: all 0.3s ease;
            border: none;
            font-size: 14px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-primary {
            background: var(--primary-gradient);
            color: white;
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(102, 126, 234, 0.4);
            color: white;
        }

        .btn-success {
            background: var(--success-color);
            color: white;
        }

        .btn-success:hover {
            background: #059669;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
        }

        .btn-warning {
            background: var(--warning-color);
            color: white;
        }

        .btn-warning:hover {
            background: #d97706;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(245, 158, 11, 0.3);
        }

        .btn-danger {
            background: var(--danger-color);
            color: white;
        }

        .btn-danger:hover {
            background: #dc2626;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
        }

        .btn-info {
            background: var(--info-color);
            color: white;
        }

        .btn-info:hover {
            background: #2563eb;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
        }

        .btn-sm {
            padding: 6px 14px;
            font-size: 13px;
        }

        /* Badge Styles */
        .badge {
            padding: 6px 12px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* Form Styles */
        .form-label {
            font-weight: 600;
            color: var(--dark-color);
            margin-bottom: 8px;
            font-size: 14px;
        }

        .form-control, .form-select {
            border-radius: 10px;
            border: 2px solid #e2e8f0;
            padding: 12px 16px;
            transition: all 0.3s ease;
            font-size: 14px;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.show {
                transform: translateX(0);
            }

            .main-wrapper {
                margin-left: 0;
            }

            .content-area {
                padding: 20px;
            }

            .topbar {
                padding: 16px 20px;
            }

            .datetime-display {
                display: none;
            }
        }

        /* Loading Animation */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .content-area > * {
            animation: fadeIn 0.5s ease-out;
        }
    </style>

    @stack('styles')
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <!-- Brand -->
        <div class="sidebar-brand">
            <div class="brand-icon">
                <i class="bi bi-heart-pulse-fill"></i>
            </div>
            <div class="brand-text">
                <h4>VetClinic</h4>
                <p>Admin Panel</p>
            </div>
        </div>

        <!-- Profile -->
        <div class="sidebar-profile">
            <div class="profile-wrapper">
                <div class="profile-avatar">
                    <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name ?? 'Admin' }}&background=fff&color=667eea&size=80&bold=true" 
                         alt="Profile" 
                         class="avatar-img">
                    <span class="avatar-status"></span>
                </div>
                <div class="profile-info">
                    <h6>{{ Auth::user()->name ?? 'Administrator' }}</h6>
                    <p>{{ Auth::user()->email ?? 'admin@vetclinic.com' }}</p>
                </div>
            </div>
        </div>

        <!-- Navigation -->
        <nav class="sidebar-nav">
            <div class="nav-section-title">Main Menu</div>
            
            <a href="{{ route('admin.dashboard') }}" class="nav-link-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <span class="nav-icon"><i class="bi bi-speedometer2"></i></span>
                <span class="nav-text">Dashboard</span>
            </a>

            <div class="nav-section-title">Data Master</div>
            
            <a href="{{ route('admin.jenis-hewan.index') }}" class="nav-link-item {{ request()->routeIs('admin.jenis-hewan.*') ? 'active' : '' }}">
                <span class="nav-icon"><i class="bi bi-grid-3x3-gap"></i></span>
                <span class="nav-text">Jenis Hewan</span>
            </a>

            <a href="{{ route('admin.ras-hewan.index') }}" class="nav-link-item {{ request()->routeIs('admin.ras-hewan.*') ? 'active' : '' }}">
                <span class="nav-icon"><i class="bi bi-collection"></i></span>
                <span class="nav-text">Ras Hewan</span>
                <span class="nav-badge">Soon</span>
            </a>

            <a href="{{ route('admin.kategori.index') }}" class="nav-link-item {{ request()->routeIs('admin.kategori.*') ? 'active' : '' }}">
                <span class="nav-icon"><i class="bi bi-tags"></i></span>
                <span class="nav-text">Kategori</span>
            </a>

            <a href="#" class="nav-link-item">
                <span class="nav-icon"><i class="bi bi-clipboard2-pulse"></i></span>
                <span class="nav-text">Kategori Klinis</span>
            </a>

            <a href="#" class="nav-link-item">
                <span class="nav-icon"><i class="bi bi-file-medical"></i></span>
                <span class="nav-text">Kode Tindakan</span>
            </a>

            <div class="nav-section-title">Manajemen Data</div>

            <a href="#" class="nav-link-item">
                <span class="nav-icon"><i class="bi bi-heart"></i></span>
                <span class="nav-text">Data Pet</span>
            </a>

            <a href="#" class="nav-link-item">
                <span class="nav-icon"><i class="bi bi-people"></i></span>
                <span class="nav-text">Data Pemilik</span>
            </a>

            <a href="#" class="nav-link-item">
                <span class="nav-icon"><i class="bi bi-person-badge"></i></span>
                <span class="nav-text">Data User</span>
            </a>

            <a href="#" class="nav-link-item">
                <span class="nav-icon"><i class="bi bi-shield-check"></i></span>
                <span class="nav-text">Role & Permission</span>
            </a>

            <div class="nav-section-title">System</div>

            <a href="#" class="nav-link-item">
                <span class="nav-icon"><i class="bi bi-gear"></i></span>
                <span class="nav-text">Pengaturan</span>
            </a>

            <a href="{{ route('logout') }}" class="nav-link-item" onclick="return confirm('Yakin ingin logout?')">
                <span class="nav-icon"><i class="bi bi-box-arrow-right"></i></span>
                <span class="nav-text">Logout</span>
            </a>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="main-wrapper">
        <!-- Topbar -->
        <div class="topbar">
            <div class="topbar-left">
                <h5>@yield('page-title', 'Dashboard')</h5>
                <div class="breadcrumb-custom">
                    @yield('breadcrumb')
                </div>
            </div>
            <div class="topbar-right">
                <button class="topbar-btn" title="Search">
                    <i class="bi bi-search"></i>
                </button>
                <button class="topbar-btn" title="Notifications">
                    <i class="bi bi-bell"></i>
                    <span class="notification-dot"></span>
                </button>
                <button class="topbar-btn" title="Settings">
                    <i class="bi bi-gear"></i>
                </button>
                <div class="datetime-display">
                    <i class="bi bi-calendar3"></i>
                    {{ date('d M Y, H:i') }}
                </div>
            </div>
        </div>

        <!-- Content Area -->
        <div class="content-area">
            <!-- Alert Messages -->
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle-fill"></i>
                    <span>{{ session('success') }}</span>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-circle-fill"></i>
                    <span>{{ session('error') }}</span>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-triangle-fill"></i>
                    <div>
                        <strong>Terjadi kesalahan:</strong>
                        <ul class="mb-0 mt-2">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <!-- Page Content -->
            @yield('content')
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Custom JS -->
    <script>
        // Mobile Sidebar Toggle
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('show');
        }

        // Auto hide alerts
        setTimeout(function() {
            let alerts = document.querySelectorAll('.alert');
            alerts.forEach(function(alert) {
                let bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            });
        }, 5000);
    </script>

    @stack('scripts')
</body>
</html>
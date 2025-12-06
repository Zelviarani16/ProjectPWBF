<!-- INI MAI CONTENT DAN EXTEND SIDEBAR YAAA -->

<!-- INI HANYA KERANGKA + SIDEBAR SESUAI REDIRECT ROLE + YIELD -->

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

    <link rel="stylesheet" href="{{ asset('css/admin/admin-base.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/table.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/stats.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/admin-forms.css') }}"> <!-- BARU -->

    @stack('styles')


    <style>
        :root {
            --sidebar-width: 280px;
            --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --light-bg: #f8fafc;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--light-bg);
            overflow-x: hidden;
        }

        /* Sidebar */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: var(--sidebar-width);
            background: var(--primary-gradient);
            color: white;
            z-index: 1000;
            overflow-y: auto;
            box-shadow: 4px 0 20px rgba(0, 0, 0, 0.1);
        }

        .sidebar .sidebar-header {
            padding: 24px;
            font-weight: 700;
            font-size: 20px;
            text-align: center;
            border-bottom: 1px solid rgba(255,255,255,0.2);
        }

        .sidebar a {
            display: block;
            padding: 14px 24px;
            color: rgba(255,255,255,0.85);
            text-decoration: none;
            transition: 0.3s;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background: rgba(255,255,255,0.2);
            color: #fff;
            padding-left: 32px;
        }

        /* MAIN CONTENT AREA */
        .main-wrapper {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
            background: var(--light-bg);
            transition: all 0.3s ease;
        }

        .content-area {
            padding: 32px;
        }

        /* Table alignment fix */
        th[style], td[style] {
            vertical-align: middle !important;
            text-align: center !important;
        }

        /* Page Header */
        .page-header-custom {
            margin-bottom: 28px;
        }

        .page-title-custom {
            font-size: 28px;
            font-weight: 700;
            color: #1a202c;
        }

        .alert-info-custom {
        background: linear-gradient(135deg, #e0f2fe 0%, #dbeafe 100%);
        border-left: 4px solid #0284c7;
        padding: 1.25rem;
        border-radius: 8px;
        color: #0c4a6e;
        }

        .alert-info-custom strong {
            color: #075985;
        }
    </style>

    

    @stack('styles')
</head>

<body>

    <!-- Sidebar -->
    @if(session('user_role') == 1)
        @include('layouts.sidebar-admin')
    @elseif(session('user_role') == 2)
        @include('layouts.sidebar-dokter')
    @elseif(session('user_role') == 3)
        @include('layouts.sidebar-perawat')
    @elseif(session('user_role') == 4)
        @include('layouts.sidebar-resepsionis')
    @elseif(session('user_role') == 5)
        @include('layouts.sidebar-pemilik')
    @endif


    <div class="main-wrapper">
        <div class="content-area">
            @yield('content')
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>

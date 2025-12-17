    <aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
        
    @php
    
        $userRole = session('user_role');

        $dashboardRoute = [
            1 => route('admin.dashboard'),
            2 => route('dokter.dashboard'),
            3 => route('perawat.dashboard'),
            4 => route('resepsionis.dashboard'),
            5 => route('pemilik.dashboard'),
        ];

        $dashboardRoute = $dashboardRoute[$userRole] ?? route('login');

    @endphp
      
      <!--begin::Sidebar Brand-->
        <!-- BRAND HEADER (LOGO ATAS) -->
        <!-- Brand Logo -->
        <div class="sidebar-brand">
            <a href="{{ $dashboardRoute }}" class="brand-link">
            <i class="bi bi-hospital-fill"></i>
            <span class="brand-text fw-light">RSHP Panel</span>
            </a>
        </div>

        <!--end::Sidebar Brand-->

        <!-- ISI MENU -->
        <!--begin::Sidebar Wrapper-->
        <div class="sidebar-wrapper">
        <nav class="mt-2">
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview">

                <li class="nav-header">MAIN MENU</li>

                {{-- DASHBOARD --}}
                <li class="nav-item">
                    <a href="{{ $dashboardRoute }}" 
                       class="nav-link {{ request()->url() === $dashboardRoute ? 'active' : '' }}">
                        <i class="nav-icon bi bi-speedometer2"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                {{-- ================= ADMIN ================= --}}
                @if(session('user_role') == 1)

                    <li class="nav-header">DATA MASTER</li>

                    <li class="nav-item">
                        <a href="{{ route('admin.jenis-hewan.index') }}"
                           class="nav-link {{ request()->routeIs('admin.jenis-hewan.*') ? 'active' : '' }}">
                            <i class="nav-icon bi bi-tag"></i>
                            <p>Jenis Hewan</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.ras-hewan.index') }}"
                           class="nav-link {{ request()->routeIs('admin.ras-hewan.*') ? 'active' : '' }}">
                            <i class="nav-icon bi bi-tags"></i>
                            <p>Ras Hewan</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.kategori.index') }}"
                           class="nav-link {{ request()->routeIs('admin.kategori.*') ? 'active' : '' }}">
                            <i class="nav-icon bi bi-folder"></i>
                            <p>Kategori</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.kategori-klinis.index') }}"
                           class="nav-link {{ request()->routeIs('admin.kategori-klinis.*') ? 'active' : '' }}">
                            <i class="nav-icon bi bi-clipboard-pulse"></i>
                            <p>Kategori Klinis</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.kode-tindakan-terapi.index') }}"
                           class="nav-link {{ request()->routeIs('admin.kode-tindakan-terapi.*') ? 'active' : '' }}">
                            <i class="nav-icon bi bi-file-medical"></i>
                            <p>Kode Tindakan Terapi</p>
                        </a>
                    </li>

                    <li class="nav-header">MANAGEMENT</li>

                    <li class="nav-item">
                        <a href="{{ route('admin.pet.index') }}"
                           class="nav-link {{ request()->routeIs('admin.pet.*') ? 'active' : '' }}">
                            <i class="nav-icon bi bi-heart"></i>
                            <p>Pet</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.user.index') }}"
                           class="nav-link {{ request()->routeIs('admin.user.*') ? 'active' : '' }}">
                            <i class="nav-icon bi bi-people"></i>
                            <p>User</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.user-role.index') }}"
                           class="nav-link {{ request()->routeIs('admin.user-role.*') ? 'active' : '' }}">
                            <i class="nav-icon bi bi-shield-check"></i>
                            <p>Role User</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.pemilik.index') }}"
                           class="nav-link {{ request()->routeIs('admin.pemilik.*') ? 'active' : '' }}">
                            <i class="nav-icon bi bi-person-badge"></i>
                            <p>Pemilik</p>
                        </a>
                    </li>

                @endif



                {{-- ================= DOKTER ================= --}}
                @if(session('user_role') == 2)
                    <li class="nav-header">MENU</li>

                    <li class="nav-item">
                        <a href="{{ route('dokter.pasien.index') }}"
                           class="nav-link {{ request()->routeIs('dokter.pasien.index') ? 'active' : '' }}">
                            <i class="nav-icon bi bi-person-lines-fill"></i>
                            <p>Data Pasien</p>
                        </a>
                    </li>


                    <li class="nav-item">
                        <a href="{{ route('dokter.pasien.pending') }}"
                           class="nav-link {{ request()->routeIs('dokter.pasien.pending') ? 'active' : '' }}">
                            <i class="nav-icon bi bi-journal-medical"></i>
                            <p>Daftar Pasien</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('dokter.rekam-medis.index') }}"
                           class="nav-link {{ request()->routeIs('dokter.rekam-medis.*') ? 'active' : '' }}">
                            <i class="nav-icon bi bi-journal-medical"></i>
                            <p>Rekam Medis</p>
                        </a>
                    </li>

                    <li class="nav-header">PROFIL</li>

                    <li class="nav-item">
                        <a href="{{ route('dokter.profil.index') }}"
                           class="nav-link {{ request()->routeIs('dokter.profil.*') ? 'active' : '' }}">
                            <i class="nav-icon bi bi-journal-medical"></i>
                            <p>Profil</p>
                        </a>
                    </li>

                @endif



                {{-- ================= PERAWAT ================= --}}
                @if(session('user_role') == 3)

                    <li class="nav-header">MENU</li>

                    <li class="nav-item">
                        <a href="{{ route('perawat.pasien.index') }}"
                           class="nav-link {{ request()->routeIs('perawat.pasien.*') ? 'active' : '' }}">
                            <i class="nav-icon bi bi-people"></i>
                            <p>Data Pasien</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('perawat.rekam-medis.index') }}"
                           class="nav-link {{ request()->routeIs('perawat.rekam-medis.*') ? 'active' : '' }}">
                            <i class="nav-icon bi bi-file-medical"></i>
                            <p>Rekam Medis</p>
                        </a>
                    </li>

                    <li class="nav-header">PROFIL</li>

                    <li class="nav-item">
                        <a href="{{ route('perawat.profil.index') }}"
                           class="nav-link {{ request()->routeIs('perawat.profil.*') ? 'active' : '' }}">
                            <i class="nav-icon bi bi-person-badge"></i>
                            <p>Profil</p>
                        </a>
                    </li>
                @endif



                {{-- ================= RESEPSIONIS ================= --}}
                @if(session('user_role') == 4)
                    <li class="nav-header">MENU</li>

                    <li class="nav-item">
                        <a href="{{ route('resepsionis.pet.index') }}"
                           class="nav-link {{ request()->routeIs('resepsionis.pet.*') ? 'active' : '' }}">
                            <i class="nav-icon bi bi-heart"></i>
                            <p>Pet</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('resepsionis.pemilik.index') }}"
                           class="nav-link {{ request()->routeIs('resepsionis.pemilik.*') ? 'active' : '' }}">
                            <i class="nav-icon bi bi-person-fill"></i>
                            <p>Pemilik</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('resepsionis.temu-dokter.index') }}"
                           class="nav-link {{ request()->routeIs('resepsionis.temu-dokter.*') ? 'active' : '' }}">
                            <i class="nav-icon bi bi-calendar-check"></i>
                            <p>Temu Dokter</p>
                        </a>
                    </li>
                @endif



                {{-- ================= PEMILIK ================= --}}
                @if(session('user_role') == 5)
                    <li class="nav-header">MENU</li>

                    <li class="nav-item">
                        <a href="{{ route('pemilik.pet.index') }}"
                           class="nav-link {{ request()->routeIs('pemilik.pet.*') ? 'active' : '' }}">
                            <i class="nav-icon bi bi-collection"></i>
                            <p>Pet Saya</p>
                        </a>
                    </li>

                    
                    <li class="nav-item">
                        <a href="{{ route('pemilik.temu-dokter.index') }}"
                           class="nav-link {{ request()->routeIs('pemilik.temu-dokter.*') ? 'active' : '' }}">
                            <i class="nav-icon bi bi-clock-history"></i>
                            <p>Jadwal Temu Dokter</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('pemilik.rekam-medis.index') }}"
                           class="nav-link {{ request()->routeIs('pemilik.rekam-medis.index*') ? 'active' : '' }}">
                            <i class="nav-icon bi bi-journal-medical"></i>
                            <p>Rekam Medis</p>
                        </a>
                    </li>

                    <li class="nav-header">PROFIL</li>

                    <li class="nav-item">
                        <a href="{{ route('pemilik.profil.index') }}"
                           class="nav-link {{ request()->routeIs('pemilik.profil.index') ? 'active' : '' }}">
                            <i class="nav-icon bi bi-person-lines-fill"></i>
                            <p>Profil</p>
                        </a>
                    </li>
                @endif

                {{-- LOGOUT --}}
                <li class="nav-item mt-3">
                    <a href="#" class="nav-link text-danger"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="nav-icon bi bi-box-arrow-right"></i>
                        <p>Logout</p>
                    </a>
                </li>

                <form id="logout-form" method="POST" action="{{ route('logout') }}" hidden>
                    @csrf
                </form>

            </ul>
        </nav>
    </div>
        <!--end::Sidebar Wrapper-->
      </aside>